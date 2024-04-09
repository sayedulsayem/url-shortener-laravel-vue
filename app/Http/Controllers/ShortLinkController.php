<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Models\Statistic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ShortLinkController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $user = $request->user();
        $urls = ShortLink::with('statistics')->where('user_id', $user->id)->latest()->get();
        return Inertia::render('Urls', [
            'urls' => $urls
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $code) {
        $shortLink = ShortLink::where('code', $code)->first();

        if(!$shortLink){
            return Redirect::back()->with([
                'status' => false,
                'message' => 'Cannot find element with code short ' . $code
            ], 404);
        }

        Statistic::create([
            'short_link_id' => $shortLink->id,
            'ip_address' => $request->ip()
        ]);

        return Redirect::away($shortLink->url);
    }

    /**
     * Display the specified resource.
     */
    public function prefixShow(Request $request, $username, $code) {
        $user = User::where('username', $username)->first();

        if(!$user){
            return Redirect::back()->with([
                'status' => false,
                'message' => 'Cannot find element with username ' . $username
            ], 404);
        }

        $shortLink = ShortLink::where([
            ['code', $code],
            ['user_id', $user->id]
        ])->first();

        if(!$shortLink){
            return Redirect::back()->with([
                'status' => false,
                'message' => 'Cannot find element with code short ' . $code
            ], 404);
        }

        Statistic::create([
            'short_link_id' => $shortLink->id,
            'ip_address' => $request->ip()
        ]);

        return Redirect::away($shortLink->url);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id) {
        $user = $request->user();
        $shortLink = ShortLink::where('user_id', $user->id)->where('id', $id)->first();

        if(!$shortLink){
            return Redirect::back()->with([
                'status' => false,
                'message' => 'Cannot find element with id ' . $id
            ], 404);
        }

        $shortLink->delete();

        return redirect()->intended('/urls')->with([
            'status' => true,
            'message' => 'The URL has been deleted'
        ]);
    }

    public function store(Request $request) {

        $user = $request->user();

        $validatedData = $request->validate([
            'url' => 'required|url|unique:short_links',
        ]);

        ShortLink::create([
            'user_id' => $user->id,
            'url' => $validatedData['url'],
            'code' => $this->generateShortCode(),
            'ip_address' => $request->ip()
        ]);

        return redirect()->intended('/urls')->with([
            'status' => true,
            'message' => 'The URL has been shorted'
        ]);
    }

    public function generateShortCode(int $length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max = strlen($characters) - 1;

        do {
            $code = '';
            for ($i = 0; $i < $length; $i++) {
                $code .= $characters[random_int(0, $max)];
            }
        } while (ShortLink::where('code', $code)->exists());

        return $code;
    }
}

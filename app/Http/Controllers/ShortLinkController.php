<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Models\Statistic;
use Ariaieboy\LaravelSafeBrowsing\Facades\LaravelSafeBrowsing;
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
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $code) {
        $tiny_url = ShortLink::where('code', $code)->first();

        if(!$tiny_url){
            return Redirect::back()->with([
                'message' => 'Cannot find element with code short ' . $code
            ], 404);
        }

        $statistic = new Statistic(['visitor' => $request->ip()]);

        $tiny_url->statistics()->save($statistic);

        return Redirect::away($tiny_url->url);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShortLink $shortLink) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShortLink $shortLink) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id) {
        $user = $request->user();
        $shortLink = ShortLink::where('user_id', $user->id)->where('id', $id)->first();

        if(!$shortLink){
            return Redirect::back()->with([
                'message' => 'Cannot find element with id ' . $id
            ], 404);
        }

        $shortLink->delete();

        return redirect()->intended('/urls')->with('message', 'The URL has been deleted');
    }

    public function store(Request $request) {

        $user = $request->user();

        $validatedData = $request->validate([
            'url' => 'required|url|unique:short_links',
        ]);

        $result = LaravelSafeBrowsing::isSafeUrl($validatedData['url'],true);
        return ($result === true)? 'safe': 'unsafe';

        ShortLink::create([
            'user_id' => $user->id,
            'url' => $validatedData['url'],
            'code' => $this->generateShortCode(),
            'ip_address' => $request->ip()
        ]);

        return redirect()->intended('/urls')->with('message', 'The URL has been shorted');
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

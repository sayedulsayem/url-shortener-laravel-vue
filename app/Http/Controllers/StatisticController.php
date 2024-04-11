<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StatisticController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $user = $request->user();
        $statistics = ShortLink::with('statistics')->where('user_id', '=', $user->id)->get();
        return Inertia::render('Dashboard', ['statistics' => $statistics]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id) {
        $user = $request->user();
        $visitors = Statistic::with(['link' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->where('short_link_id', $id)->get();

        return Inertia::render('Statistic', ['visitors' => $visitors]);
    }
}

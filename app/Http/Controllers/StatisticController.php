<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Models\Statistic;
use App\Models\User;
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
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id) {
        $user = $request->user();
        $visitors = Statistic::with('link')->get();
        return Inertia::render('Statistic', ['visitors' => $visitors]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Statistic $statistic) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Statistic $statistic) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Statistic $statistic) {
        //
    }
}

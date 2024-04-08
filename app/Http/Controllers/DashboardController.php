<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller {
    public function getDashBoard(Request $request) {
        $user = $request->user();
        return Inertia::render('Dashboard');
    }
    public function getUrls(Request $request) {
        $user = $request->user();
        return Inertia::render('Urls');
    }
    public function getProfile(Request $request) {
        $user = $request->user();
        return Inertia::render('Profile');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller {
    public function getDashBoard(Request $request) {
        $user = $request->user();
        return Inertia::render('users/Dashboard');
    }
}

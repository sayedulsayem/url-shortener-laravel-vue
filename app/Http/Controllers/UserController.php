<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller {
    public function getRegisterPage() {
        return Inertia::render('Register');
    }

    public function register(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed',
        ]);

        User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->intended('/login');
    }

    public function getLoginPage() {
        return Inertia::render('Login');
    }

    public function loginWithRemember(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'boolean',
        ]);
        $remember = $validatedData['remember'] ?? false;
        if (Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']], $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/users/dashboard');
        }
        return Redirect::back()->with([
            'message' => 'Invalid login credentials'
        ], 422);
    }

    public function login(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'boolean',
        ]);

        $remember = $validatedData['remember'] ?? false;

        if (Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']], $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/users/dashboard');
        }

        return Redirect::back()->with([
            'message' => 'Invalid login credentials'
        ], 422);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $user = Auth::guard()->user();
        if ($user) {
            $user->forceFill([
                'remember_token' => null,
            ])->save();
        }
        return redirect()->intended('/login');
    }
}
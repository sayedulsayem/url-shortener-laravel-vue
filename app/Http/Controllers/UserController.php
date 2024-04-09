<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Carbon\Carbon;
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
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->intended('/login');
    }

    public function getLoginPage() {
        return Inertia::render('Login');
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
            return redirect()->intended('/');
        }

        return Redirect::back()->with([
            'status' => false,
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

    public function getProfile(Request $request) {
        $user = $request->user();
        return Inertia::render('Profile', [
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request) {
        $user = $request->user();

        $inputValidations = [
            'name' => 'required',
            'use_prefix' => 'boolean',
        ];

        if($user->username !== $request->username) {
            $inputValidations['username'] = 'required|unique:users';
        }

        if (!empty($request->old_password) && !Hash::check($request->old_password, $user->password)) {
            return Redirect::back()->with([
                'message' => 'Invalid old password'
            ], 422);
        }

        if (!empty($request->password)) {
            $inputValidations['password'] = 'required|min:5|confirmed';
        }

        $validatedData = $request->validate($inputValidations);

        $data = [
            'name' => $validatedData['name'],
            'use_prefix' => $validatedData['use_prefix'],
        ];

        if(isset($validatedData['username'])) {
            $data['username'] = $validatedData['username'];
        }

        if (!empty($validatedData['password'])) {
            $data['password'] = Hash::make($validatedData['password']);
        }

        $user->update($data);

        return redirect()->intended('/profile')->with([
            'status' => true,
            'message' => 'Profile updated successfully.'
        ], 200);
    }
}

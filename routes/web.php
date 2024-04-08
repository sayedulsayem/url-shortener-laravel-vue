<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'getLoginPage'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login');

    Route::get('/register', [UserController::class, 'getRegisterPage'])->name('register');
    Route::post('/register', [UserController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'getDashBoard'])->name('home');
    Route::get('/urls', [DashboardController::class, 'getUrls'])->name('urls');
    Route::get('/profile', [DashboardController::class, 'getProfile'])->name('profile');
});
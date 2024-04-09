<?php

use App\Http\Controllers\ShortLinkController;
use App\Http\Controllers\StatisticController;
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

    Route::get('/urls', [ShortLinkController::class, 'index'])->name('urls.index');
    Route::post('/urls', [ShortLinkController::class, 'store'])->name('urls.store');
    Route::delete('/urls/{id}', [ShortLinkController::class, 'destroy'])->name('urls.destroy');
    Route::get('/profile', [UserController::class, 'getProfile'])->name('profile');
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile');

    Route::get('/', [StatisticController::class, 'index'])->name('statistics.index');
    Route::get('/visitors/{id}', [StatisticController::class, 'show'])->name('statistics.show');
});

Route::get('/{code}', [ShortLinkController::class, 'show'])->name('show');
Route::get('/{username}/{code}', [ShortLinkController::class, 'prefixShow'])->name('prefix.show');
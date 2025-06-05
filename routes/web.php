<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home.home');
})->middleware('auth')->name('home'); // Authenticated users only, if not, go to login

Route::get('/home', function () {
    return view('home.home');
})->middleware('auth')->name('home'); // Authenticated users only, if not, go to login

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('show.login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('signup', [AuthController::class, 'showSignupForm'])->name('show.signup');
    Route::post('signup', [AuthController::class, 'signup'])->name('signup.submit');
});

Route::middleware('auth')->group(function() {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    //Profile edit & update
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'update'])->name('profile.update');

    //Profile show (by username)
    Route::get('/profile/{username}', [UserController::class, 'show'])->name('profile.show');
});


   





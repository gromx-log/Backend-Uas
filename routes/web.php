<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home.home');
})->middleware('auth')->name('home'); // Authenticated users only

Route::get('/home', function () {
    return view('home.home');
})->middleware('auth')->name('home'); // Authenticated users only

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('show.login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('signup', [AuthController::class, 'showSignupForm'])->name('show.signup');
    Route::post('signup', [AuthController::class, 'signup'])->name('signup.submit');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    // Posts
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Follows
    Route::post('/users/{user}/follow', [FollowController::class, 'follow'])->name('users.follow');
    Route::delete('/users/{user}/follow', [FollowController::class, 'unfollow'])->name('users.unfollow');
    Route::get('/users/{user}/followers', [FollowController::class, 'followers'])->name('users.followers');
    Route::get('/users/{user}/following', [FollowController::class, 'following'])->name('users.following');

    // Profile edit & update
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'update'])->name('profile.update');

    // Profile show (by username)
    Route::get('/profile/{username}', [UserController::class, 'show'])->name('profile.show');
});

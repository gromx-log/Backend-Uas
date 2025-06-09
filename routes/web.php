<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\HomeController;


// home
Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');

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
    // Reply to a post
    Route::post('/posts/{post}/reply', [PostController::class, 'reply'])->name('posts.reply');

    // Follows
    Route::post('/users/{user}/follow', [FollowsController::class, 'follow'])->name('users.follow');
    Route::delete('/users/{user}/follow', [FollowsController::class, 'unfollow'])->name('users.unfollow');
    Route::get('/users/{user}/followers', [FollowsController::class, 'followers'])->name('users.followers');
    Route::get('/users/{user}/following', [FollowsController::class, 'following'])->name('users.following');


    // Profile edit & update
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'update'])->name('profile.update');

    // Profile show (by username)
    Route::get('/profile/{userHandle}', [UserController::class, 'show'])->name('profile.show');

    
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookmarksController;
//Digunakan prefix untuk mengelompokkan route yang berhubungan dengan fitur tertentu
/*
|--------------------------------------------------------------------------
| Public Route (Yang Bisa Diakses Tanpa Login)
|--------------------------------------------------------------------------
Dipindahkan ke paling bawah*/ 

// Home page redirects
Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| Guest Routes (Unauthenticated users only)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    // Autentikasi
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('show.login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');
    
    Route::get('signup', [AuthController::class, 'showSignupForm'])->name('show.signup');
    Route::post('signup', [AuthController::class, 'signup'])->name('signup.submit');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes  (Yang Harus Login untuk Akses)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    
    // Authentication
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    // Posts Management
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('create', [PostController::class, 'create'])->name('create');
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::get('{post}', [PostController::class, 'show'])->name('show');
        Route::delete('{post}', [PostController::class, 'destroy'])->name('destroy');
        Route::post('{post}/reply', [PostController::class, 'reply'])->name('reply');
        Route::post('{post}/like', [LikesController::class, 'like'])->name('like');
        Route::delete('{post}/like', [LikesController::class, 'unlike'])->name('unlike');
    });
    
    // Bookmarks
    Route::prefix('bookmarks')->name('bookmarks.')->group(function () {
        Route::get('/', [BookmarksController::class, 'index'])->name('index');
        Route::post('posts/{postId}/bookmark', [BookmarksController::class, 'toggle'])->name('toggle');
    });
    
    // Follow System
    Route::prefix('users')->name('users.')->group(function () {
        Route::post('{user}/follow', [FollowsController::class, 'follow'])->name('follow');
        Route::delete('{user}/unfollow', [FollowsController::class, 'unfollow'])->name('unfollow');
        Route::get('{user}/follow-status', [FollowsController::class, 'getFollowStatus'])->name('follow-status');
    });
    
    // Alternative follow routes (for backward compatibility)
    Route::post('follow/{user}', [FollowsController::class, 'follow'])->name('follow');
    Route::post('unfollow/{user}', [FollowsController::class, 'unfollow'])->name('unfollow');
    
    // Profile Management 
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/', [UserController::class, 'update'])->name('update');
    });

    // User Search
    Route::prefix('search')->name('search.')->group(function () {
        Route::get('/', [UserController::class, 'search'])->name('users');
    });

    // Public profile views (accessible without auth)
Route::get('/profile/{userHandle}', [UserController::class, 'show'])->name('profile.show');
Route::get('/users/{userHandle}', [FollowsController::class, 'show'])->name('users.show');
Route::get('/users/{userHandle}/followers', [FollowsController::class, 'followers'])->name('users.followers');
Route::get('/users/{userHandle}/following', [FollowsController::class, 'following'])->name('users.following');
});





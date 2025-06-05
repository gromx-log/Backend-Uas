<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Pastikan model User sudah ada

class UserController extends Controller
{
    public function show($username)
    {
    $user = User::where('username', $username)
        ->withCount(['followers', 'following']) // opsional kalau ada relasi followers
        ->firstOrFail();
        
    $isFollowing = auth()->check() && auth()->user()->isFollowing($user->userId);

    return view('profile.show', compact('user', 'isFollowing'));
    }

    public function edit()
    {
    $user = auth()->user();
    return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
    $user = auth()->user();
    $request->validate([
        'username' => 'required|string|max:20|unique:users,username,' . $user->id,
        'display_name' => 'required|string|max:30',
        'bio' => 'nullable|string|max:160',
    ]);

    $user->update($request->only('username', 'display_name', 'bio'));

    return redirect()->route('profile.show', $user->username)->with('success', 'Profile updated!');
    }
}

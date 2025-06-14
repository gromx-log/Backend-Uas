<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Pastikan model User sudah ada

class UserController extends Controller
{
    public function show($userHandle)
    {
    $user = User::where('userHandle', $userHandle)
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
            'username' => 'required|string|max:20|unique:users,username,' . $user->userId . ',userId',
            'userHandle' => 'required|string|max:20|unique:users,userHandle,' . $user->userId . ',userId',
            'bio' => 'nullable|string|max:160',
        ]);

        $user->update($request->only('username', 'userHandle', 'bio'));

        return redirect()->route('profile.show', $user->userHandle)->with('success', 'Profile updated!');
    }

//search features 
    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('username', 'like', '%' . $query . '%')
            ->orWhere('userHandle', 'like', '%' . $query . '%')
            ->get();

        $user = auth()->user();
        $posts = []; 

        return view('home.home', compact('users', 'query', 'user', 'posts'));
    }
}

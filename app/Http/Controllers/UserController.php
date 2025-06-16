<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Post; 

class UserController extends Controller
{
    // show specified user's profile page
    public function show($userHandle)
    {
        $user = User::where('userHandle', $userHandle)
            ->withCount(['followers', 'following'])
            ->firstOrFail();

        $posts = $user->posts()->latest()->get();
            
        $isFollowing = auth()->check() && auth()->user()->isFollowing($user->userId);

        return view('profile.show', compact('user', 'isFollowing','posts'));
    }

    // show currently logged-in user's profile edit page
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    // update user's profile info 
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

    // search a user 
    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('username', 'like', '%' . $query . '%')
            ->orWhere('userHandle', 'like', '%' . $query . '%')
            ->get();

        $user = auth()->user();
        // Always show the latest posts on home, even when searching
        $posts = Post::with('user')
            ->whereNull('parent_post_id')
            ->latest('created_at')
            ->get();

        return view('home.home', compact('users', 'query', 'user', 'posts'));
    }
}

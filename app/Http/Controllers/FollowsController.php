<?php

namespace App\Http\Controllers;

use App\Models\follows;
use Illuminate\Http\Request;
use App\Models\User;


class FollowsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(follows $follows)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(follows $follows)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, follows $follows)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(follows $follows)
    {
        //
    }

    public function follow(Request $request, User $user)
    {
        $currentUser = auth()->user();
        
        if ($currentUser->id == $user->id) {
            return response()->json(['error' => 'You cannot follow yourself'], 400);
        }

        $currentUser->follow($user->id);
        
        return response()->json([
            'status' => 'followed',
            'followers_count' => $user->followersCount()
        ]);
    }

    public function unfollow(Request $request, User $user)
    {
        auth()->user()->unfollow($user->id);
        
        return response()->json([
            'status' => 'unfollowed', 
            'followers_count' => $user->followersCount()
        ]);
    }

    public function followers(User $user)
    {
        $followers = $user->followers()->paginate(20);
        return view('users.followers', compact('user', 'followers'));
    }

    public function following(User $user) 
    {
        $following = $user->following()->paginate(20);
        return view('users.following', compact('user', 'following'));
    }

}

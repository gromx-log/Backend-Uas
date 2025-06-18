<?php

namespace App\Http\Controllers;

use App\Models\Follows;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    public function follow(User $user)
    {
        $follower = Auth::user();

        // Cegah follow diri sendiri
        if ($follower->userId == $user->userId) {
            return back()->with('error', 'Kamu tidak bisa follow dirimu sendiri.');
        }

        // Cek apakah sudah follow
        if (!$follower->isFollowing($user->userId)) {
            $follower->following()->attach($user->userId);
        }

        return back();
    }

    public function unfollow(User $user)
    {
        $follower = Auth::user();
        $follower->following()->detach($user->userId);
        return back();
    }

    public function followers($userHandle)
    {
        $user = User::where('userHandle', $userHandle)->firstOrFail();
        
        // Fix: Remove the created_at ordering since the column doesn't exist
        $followers = $user->followers()
            ->select('users.userId', 'users.username', 'users.userHandle', 'users.bio')
            ->paginate(20);

        // Check if current user is following each follower
        if (auth()->check()) {
            $followers->getCollection()->transform(function ($follower) {
                $follower->is_following = auth()->user()->isFollowing($follower->userId);
                return $follower;
            });
        }

        return view('users.followers', compact('user', 'followers'));
    }

    public function following($userHandle)
    {
        $user = User::where('userHandle', $userHandle)->firstOrFail();
        
        // Fix: Remove the created_at ordering since the column doesn't exist
        $following = $user->following()
            ->select('users.userId', 'users.username', 'users.userHandle', 'users.bio')
            ->paginate(20);

        // Check if current user is following each user
        if (auth()->check()) {
            $following->getCollection()->transform(function ($followedUser) {
                $followedUser->is_following = auth()->user()->isFollowing($followedUser->userId);
                return $followedUser;
            });
        }

        return view('users.following', compact('user', 'following'));
    }

    public function show($userHandle)
    {
        // Ganti agar render ke 'profile.show' (bukan 'users.show')
        $user = User::where('userHandle', $userHandle)->firstOrFail();
        $isFollowing = auth()->check() ? auth()->user()->isFollowing($user->userId) : false;
        
        // Get user's posts
        $posts = $user->posts()->with('user')->latest()->paginate(10);

        return view('profile.show', compact('user', 'isFollowing', 'posts'));
    }

    // API endpoint to get follow status
    public function getFollowStatus($userId)
    {
        if (!auth()->check()) {
            return response()->json(['is_following' => false]);
        }

        $user = User::findOrFail($userId);
        $isFollowing = auth()->user()->isFollowing($userId);

        return response()->json([
            'is_following' => $isFollowing,
            'followers_count' => $user->followersCount(),
            'following_count' => $user->followingCount()
        ]);
    }
}
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
        if ($follower->id == $user->userId) {
            return back()->with('error', 'Kamu tidak bisa follow dirimu sendiri.');
        }
        $userIdToFollow = $user->getKey(); // ini akan ambil 'userId' karena sudah override
        // Cek apakah sudah follow
        if (!$follower->following->contains($userIdToFollow)) {
            $follower->following()->attach($userIdToFollow);
        }

        return back();
    }

    public function unfollow(User $user)
    {
        $follower = Auth::user();

        $follower->following()->detach($user->id);

        return back();
    }


    public function followers($userHandle)
    {
        $user = User::where('userHandle', $userHandle)->firstOrFail();
        $followers = $user->followers()
            ->select('users.userId', 'users.username', 'users.userHandle', 'users.bio')
            ->withPivot('created_at')
            ->orderBy('follows.created_at', 'desc')
            ->paginate(20);

        // Check if current user is following each follower
        if (auth()->check()) {
            $currentUserId = auth()->user()->userId;
            $followers->getCollection()->transform(function ($follower) use ($currentUserId) {
                $follower->is_following = auth()->user()->isFollowing($follower->userId);
                return $follower;
            });
        }

        return view('users.followers', compact('user', 'followers'));
    }

    public function following($userHandle)
    {
        $user = User::where('userHandle', $userHandle)->firstOrFail();
        $following = $user->following()
            ->select('users.userId', 'users.username', 'users.userHandle', 'users.bio')
            ->withPivot('created_at')
            ->orderBy('follows.created_at', 'desc')
            ->paginate(20);

        // Check if current user is following each user
        if (auth()->check()) {
            $currentUserId = auth()->user()->userId;
            $following->getCollection()->transform(function ($followedUser) use ($currentUserId) {
                $followedUser->is_following = auth()->user()->isFollowing($followedUser->userId);
                return $followedUser;
            });
        }

        return view('users.following', compact('user', 'following'));
    }

    public function show($userHandle)
    {
        $user = User::where('userHandle', $userHandle)->firstOrFail();
        $isFollowing = auth()->check() ? auth()->user()->isFollowing($user->userId) : false;
        
        // Get user's posts
        $posts = $user->posts()->with('user')->latest()->paginate(10);

        return view('users.show', compact('user', 'isFollowing', 'posts'));
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
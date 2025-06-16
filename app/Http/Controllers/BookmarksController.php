<?php

namespace App\Http\Controllers;

use App\Models\Bookmarks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

class BookmarksController extends Controller
{
    /**
     * Display a listing of all bookmarked post.
     */

     public function index()
     {
         $user = Auth::user();
     
         $bookmarks = $user->bookmarks()->with('user')->get();
     
         return view('bookmarks.index', compact('bookmarks'));
     }

    // bookmark and unbookmark specified post
     public function toggle($postId)
     {
        $user = Auth::user();
        $post = Post::findOrFail($postId);

        if ($user->bookmarks()->where('bookmarks.postId', $postId)->exists()) {
            $user->bookmarks()->detach($postId);
            return back()->with('success', 'Unbookmarked Post Successfully.');
        } else {
            $user->bookmarks()->attach($postId);
            return back()->with('success', 'Post Successfully Bookmarked!');
        }
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
    public function show(Bookmarks $bookmarks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bookmarks $bookmarks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bookmarks $bookmarks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bookmarks $bookmarks)
    {
        //
    }

}

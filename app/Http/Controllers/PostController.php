<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('home.post', compact('posts'));
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
        // cek input
        $request->validate([
            'content' => 'required|string|max:280',
            'parent_post_id' => 'nullable|exists:posts,postId', // untuk reply
            ]);
    
        // simpan post baru
        $post = Post::create([
            'userId' => Auth::id(), 
            'content' => $request->content,
            'parent_post_id' => $request->parent_post_id,
        ]);

        return redirect()->route('posts.index')->with('success', 'Postingan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->userId !== Auth::id()) {
            return redirect()->route('posts.index')->with('error', 'Anda tidak diizinkan menghapus postingan ini.');
        }
    
        $post->delete();
    
        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus!');
    }
}

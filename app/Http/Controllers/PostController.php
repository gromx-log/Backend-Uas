<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display all posts in home.
     */
    public function index()
    {
        $user = Auth::user();
        $posts = Post::with('user')
            ->whereNull('parent_post_id') // Hanya post utama
            ->latest('created_at')
            ->get();

        return view('home.home', compact('posts','user'));
    }

    /**
     * Show post creation form.
     */
    public function create()
    {
         return view('posts.post');
    }

    /**
     * Store a newly created post in storage.
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
        
        return redirect()->route('home')->with('success', 'Post Successfully Posted!');
    }

    /**
     * Display the specified post.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(Post $post)
    {
        // Only allow editing own comment/reply
        if ($post->userId !== Auth::id()) {
            return redirect()->route('posts.show', $post->parent_post_id ?: $post->postId)
                ->with('error', 'You are not allowed to edit this post.');
        }
        
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, Post $post)
    {
        if ($post->userId !== Auth::id()) {
            return redirect()->route('posts.create')->with('error', 'You are not allowed to edit this post.');
        }
        $request->validate([
            'content' => 'required|string|max:280',
        ]);
        $post->content = $request->input('content');
        $post->save();

        // Always redirect to home after editing a comment
        return redirect()->route('home')->with('success', 'Post Edited Successfully!');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->userId !== Auth::id()) {
            return redirect()->route('posts.create')->with('error', 'You are not allowed to delete this post.');
        }
    
        $post->delete();
        
        return redirect()->route('home')->with('success', 'Post Deleted Successfully!');
    }
    //Fungsi reply
    public function reply(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:280',
        ]);

        $originalPost = Post::findOrFail($postId);

        $reply = Post::create([
            'userId' => auth()->id(),
            'content' => $request->input('content'),
            'parent_post_id' => $originalPost->postId,
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Reply posted!');
    }
}

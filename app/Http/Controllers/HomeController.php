<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    // show home
    public function index()
    {
        $user = Auth::user();

        // show posts in home
        $posts = Post::with(['user', 'replies.user']) 
                    ->whereNull('parent_post_id')
                    ->latest('created_at')
                    ->get();
     

        return view('home.home', compact('posts', 'user'));
    }
}


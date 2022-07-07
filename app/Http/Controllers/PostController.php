<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest();
        if (request('search')) {
            $posts->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('body', 'like', '%' . request('search') . '%');
        }

        // Render the 'posts' view, and pass in the collection of Posts
        return view('posts',
            [
                'posts' => $posts->with('category', 'author')->get(),
                'categories' => Category::all()
            ]);
    }
}

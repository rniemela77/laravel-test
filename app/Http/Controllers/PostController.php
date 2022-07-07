<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // Render the 'posts' view, and pass in the collection of Posts
        return view('posts',
            [
                'posts' => Post::latest()->filter(request(['search', 'category']))->get(),
                'categories' => Category::all()
            ]);
    }

    public function show(Post $post)
    {
        // Find a post by its slug and pass it to a view called "post"
        return view('post', [
            'post' => $post
        ]);
    }
}

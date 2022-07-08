<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // Render the 'posts' view, and pass in the collection of Posts
        return view('posts.index',
            [
                'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(3)
            ]);
    }

    public function show(Post $post)
    {
        // Find a post by its slug and pass it to a view called "post"
        return view('posts.show', [
            'post' => $post
        ]);
    }
}

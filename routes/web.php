<?php

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // Render the 'posts' view, and pass in the collection of Posts
    return view('posts',
        [
            'posts' => Post::with('category')->get()
        ]);
});

Route::get('posts/{post}', function (Post $post) { // Post::where('slug', $post)->firstOrFail()
    // Find a post by its slug and pass it to a view called "post"
    return view('post', [
        'post' => $post
    ]);
});

Route::get('/categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'posts' => $category->posts
    ]);
});

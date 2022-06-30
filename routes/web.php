<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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
    // Collect all the files in the /posts/ directory
    $posts = collect(File::files(resource_path("posts")))
        ->map(function ($file) {
            // Loop through the collection and return each document, parsed
            return YamlFrontMatter::parseFile($file);
        })
        ->map(function ($document) {
            // Convert each document into a Post
            return new Post(
                $document->title,
                $document->excerpt,
                $document->date,
                $document->body(),
                $document->slug
            );
        });

    // Render the 'posts' view, and pass in the collection of Posts
    return view('posts',
        [
            'posts' => $posts
        ]);
});

Route::get('posts/{post}', function ($slug) {
    // Find a post by its slug and pass it to a view called "post"
    return view('post', [
        'post' => Post::find($slug)
    ]);
})->where('post', '[A-z_\-]+');

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;


    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }


    public static function all()
    {
        // Cache all posts forever
        return cache()->rememberForever('posts.all', function () {
            // Collect all the files in the /posts/ directory
            return collect(File::files(resource_path("posts")))
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
                })
                ->sortByDesc('date');
        });
    }

    public static function find($slug)
    {
        // Grab all the blog posts
        $posts = static::all();

        // Return the post with the matching slug
        return $posts->firstWhere('slug', $slug);
    }

    public static function findOrFail($slug)
    {
        // Find the blog post
        $post = static::find($slug);

        // If no post is found, throw exception
        if (!$post) {
            throw new ModelNotFoundException();
        }

        // Else, return the post
        return $post;
    }
}

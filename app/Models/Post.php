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
            });
    }

    public static function find($slug)
    {
        // Grab all the blog posts
        $posts = static::all();

        // Return the blog post with the correct slug
        return $posts->firstWhere('slug', $slug);
    }
}

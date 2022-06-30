<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post
{
    public static function find($slug) {
        // Find the page from the slug
        if (!file_exists($path = resource_path("posts/{$slug}.html"))) {
            throw new ModelNotFoundException();
        }

        // Cache the page in memory for 1200 seconds
        return cache()->remember("posts.{$slug}", 1200, function() use ($path) {
            return file_get_contents($path);
        });
    }
}

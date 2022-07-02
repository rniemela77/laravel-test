<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Empty out the tables
        User::truncate();
        Category::truncate();
        Post::truncate();

        // Create 1 user in the factory
         $user = User::factory()->create();

         $personal = Category::create([
             'name' => 'Personal',
             'slug' => 'personal'
         ]);

        $work = Category::create([
            'name' => 'Work',
            'slug' => 'work'
        ]);

        $hobby = Category::create([
            'name' => 'Hobby',
            'slug' => 'hobby'
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $personal->id,
            'title' => 'fake post title',
            'slug' => 'fake_slug',
            'excerpt' => 'fake excerpt',
            'body' => 'fake body'
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $work->id,
            'title' => 'fake post title 2',
            'slug' => 'fake_slug_2',
            'excerpt' => 'fake excerpt222',
            'body' => 'fake body222'
        ]);
    }
}

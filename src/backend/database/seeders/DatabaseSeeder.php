<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
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
        // Create users and posts
         User::factory(10)
             ->has(Post::factory()->count(rand(1, 5)), 'posts')
             ->create();

         // Create comments for posts
         Comment::factory()
             ->count(rand(10, 20))
             ->for(Post::factory(), 'commentable')
             ->create();
    }
}

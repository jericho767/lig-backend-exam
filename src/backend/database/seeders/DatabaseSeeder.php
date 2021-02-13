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
         User::factory()
             ->count(rand(1,5))
             ->has(
                 Post::factory()
                     ->count(rand(2,3))
                     ->has(Comment::factory()->count(rand(1,3)), 'comments'),
                 'posts'
             )
             ->create();
    }
}

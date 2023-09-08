<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()
            ->has(
                Post::factory(20)
            )
            ->create([
            'username' => 'test_user',
            'email' => 'test@example.com',
        ]);

        User::factory(20)
            ->has(
                Post::factory(20)
                    ->has(Comment::factory(10)
                        ->for($user), 'comments')
            )
            ->create();
    }
}

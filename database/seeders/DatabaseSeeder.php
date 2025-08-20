<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'ict',
            'email' => 'ict@example.com',
            'password' => Hash::make('password'),
        ]);

        $categories = Category::factory()
            ->count(8)
            ->create();

        Post::factory(20)->create(['user_id' => $user->id])
            ->each(function ($post) use ($categories) {
                $post->categories()->sync(
                    $categories->random(rand(1, 3))->pluck('id')
                );

                Comment::factory(rand(0, 4))->create([
                    'post_id' => $post->id,
                    'user_id' => $post->user_id,
                ]);
            });
    }
}

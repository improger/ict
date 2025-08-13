<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $faker = fake('en_US');

        return [
            'user_id' => User::factory(),
            'title' => $faker->sentence(6),
            'body' => '<p>' . implode('</p><p>', $faker->paragraphs(3)) . '</p>',
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() : array
    {
        return [
            'user_id' => fake()->randomElement([6, 8]),
            'title' => fake()->sentence(5),
            'body' => fake()->sentence(20),
            'image' => fake()->uuid() . '.jpg'
        ];
    }
}

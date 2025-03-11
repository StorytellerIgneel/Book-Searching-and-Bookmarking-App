<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), 
            'name' => fake()->name(),
            'profile_path' => fake()->optional()->imageUrl(), 
            'bio' => fake()->optional()->text(200), 
            'is_visible' => fake()->boolean(80), 
        ];
    }
}

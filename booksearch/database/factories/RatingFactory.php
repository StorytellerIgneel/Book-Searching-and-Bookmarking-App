<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Book;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
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
            'book_id' => Book::factory(),
            // 'user_id' => rand(2, 50),
            // 'book_id' => rand(1, 200),
            'score' => rand(1, 5),
        ];
    }
}

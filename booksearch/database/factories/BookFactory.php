<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Rating;
use App\Models\Favourite;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => rand(1,100), //Create 100 authors first
            'title' => fake()->unique()->sentence(3),
            'synopsis' => fake()->paragraph(),
            'cover_image_link' => fake()->imageUrl()
        ];
    }

    public function hasRatings(int $count){
        return $this->has(Rating::factory()->count($count), 'ratings');
    }

    public function hasFavourites(int $count){
        return $this->has(Favourite::factory()->count($count), 'favourites');
    }
}

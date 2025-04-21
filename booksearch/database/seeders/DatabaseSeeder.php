<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Author;
use App\Models\Favourite;
use App\Models\Rating;
use App\Models\Book;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->admin()->create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
        ]);

        User::factory()->create([
            'username' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('user'),
        ]);

        Author::factory(100)->create();

        foreach (range(1, 500) as $_) {
            Book::factory()
                ->hasRatings(rand(1, 5))
                ->hasFavourites(rand(1, 10))
                ->create();
        }

    }
}

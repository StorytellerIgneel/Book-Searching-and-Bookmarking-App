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

        User::factory(20)->create();

        Author::factory(20)->create();

        Book::factory(200)->create();

        $this->call([
            RatingSeeder::class,
            FavouriteSeeder::class,
        ]);

        Favourite::factory(500)->create()->unique(['user_id', 'book_id']);
    }
}

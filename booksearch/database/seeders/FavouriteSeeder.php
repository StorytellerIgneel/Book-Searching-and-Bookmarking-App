<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Favourite;
use Illuminate\Database\QueryException;

class FavouriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->createUniqueFavourites(500);
    }

    protected function createUniqueFavourites($count)
    {
        $created = 0;
        $attempts = 0;
        $maxAttempts = $count * 2;
        
        while ($created < $count && $attempts < $maxAttempts) {
            try {
                Favourite::factory()->create();
                $created++;
            } catch (QueryException $e) {
                if (!str_contains($e->getMessage(), 'Duplicate entry')) {
                    throw $e;
                }
            }
            $attempts++;
        }
        
        $this->command->info("Created {$created} unique favourites (attempted {$attempts} times)");
        
        return $created;
    }
}

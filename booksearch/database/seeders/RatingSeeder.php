<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rating;
use Illuminate\Database\QueryException;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->createUniqueRatings(500);
    }

    protected function createUniqueRatings($count)
    {
        $created = 0;
        $attempts = 0;
        $maxAttempts = $count * 2; // Prevent infinite loops
        
        while ($created < $count && $attempts < $maxAttempts) {
            try {
                Rating::factory()->create();
                $created++;
            } catch (QueryException $e) {
                if (!str_contains($e->getMessage(), 'Duplicate entry')) {
                    throw $e;
                }
            }
            $attempts++;
        }
        
        $this->command->info("Created {$created} unique ratings (attempted {$attempts} times)");
        
        return $created;
    }
}

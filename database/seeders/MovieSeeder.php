<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        Movie::factory()->count(20)->make()->each(function ($movie) {
            Movie::firstOrCreate(
                ['titulo' => $movie->titulo],
                $movie->toArray()
            );
        });
    }
}

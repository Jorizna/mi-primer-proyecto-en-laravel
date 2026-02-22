<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rating;
use App\Models\User;
use App\Models\Movie;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $movies = Movie::all();

        foreach ($users as $user) {
            $moviesToRate = $movies->random(rand(3, 5));

            foreach ($moviesToRate as $movie) {
                Rating::firstOrCreate(
                    ['user_id' => $user->id, 'content_id' => $movie->id],
                    ['score' => rand(1, 5)]
                );
            }
        }
    }
}

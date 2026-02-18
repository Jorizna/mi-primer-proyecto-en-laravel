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
            // Elegimos un número aleatorio de películas para que cada usuario valore
            $moviesToRate = $movies->random(rand(3,5));

            foreach ($moviesToRate as $movie) {
                // Solo crear rating si no existe
                if (!Rating::where('user_id', $user->id)->where('content_id', $movie->id)->exists()) {
                    Rating::create([
                        'user_id' => $user->id,
                        'content_id' => $movie->id,
                        'score' => rand(1,5),
                    ]);
                }
            }
        }
    }
}

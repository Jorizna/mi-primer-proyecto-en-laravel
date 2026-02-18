<?php

namespace Database\Factories;

use App\Models\Rating;
use App\Models\User;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    protected $model = Rating::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id, // usuario aleatorio
            'content_id' => Movie::inRandomOrder()->first()->id, // película aleatoria
            'score' => $this->faker->numberBetween(1,5), // puntuación entre 1 y 5
        ];
    }
}

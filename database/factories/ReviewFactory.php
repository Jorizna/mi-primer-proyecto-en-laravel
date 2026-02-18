<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'content_id' => Movie::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence(3), // título breve
            'content' => $this->faker->paragraph(2), // comentario más largo
        ];
    }
}

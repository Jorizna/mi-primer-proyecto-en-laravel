<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'content_id' => Movie::factory(),
            'title' => $this->faker->sentence(3),
            'content' => $this->faker->paragraph(2),
        ];
    }
}

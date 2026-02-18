<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    protected $model = Movie::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'titulo' => $this->faker->sentence(3),
            'director' => $this->faker->name(),
            'año_estreno' => $this->faker->numberBetween(1980, 2024),
            'duracion' => $this->faker->numberBetween(80, 180),
            'genero' => $this->faker->randomElement(['Acción', 'Drama', 'Comedia', 'Terror', 'Ciencia ficción']),
            'sinopsis' => $this->faker->paragraph(3),
            'reparto' => $this->faker->sentence(5),
            'imagen' => null,
        ];
    }
}

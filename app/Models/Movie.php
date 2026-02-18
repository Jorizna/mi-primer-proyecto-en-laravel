<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titulo',
        'director',
        'año_estreno',
        'duracion',
        'genero',
        'sinopsis',
        'reparto',
        'imagen',
        'rating',
        'average_rating'
    ];

    protected $casts = [
        'duracion' => 'integer',
        'año_estreno' => 'integer',
    ];
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'content_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'content_id');
    }

    public function averageRating()
    {
        return round($this->ratings()->avg('score'), 2); // redondea a 2 decimales
    }
}

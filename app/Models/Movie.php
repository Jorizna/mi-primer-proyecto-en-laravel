<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Rating;
use App\Models\Review;
use App\Models\User;

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
    ];

    protected $casts = [
        'duracion' => 'integer',
        'año_estreno' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class, 'content_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'content_id');
    }

    public function updateAverageRating(): float
    {
        $average = $this->ratings()->avg('score') ?? 0;
        return round($average, 2);
    }
}

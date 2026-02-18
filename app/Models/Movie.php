<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content_id',
        'score',
    ];

    protected $casts = [
        'score' => 'integer',
    ];

    // Relación con el usuario que hizo la valoración
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el contenido (Movie)
    public function content(): BelongsTo
    {
        return $this->belongsTo(Movie::class, 'content_id');
    }
}

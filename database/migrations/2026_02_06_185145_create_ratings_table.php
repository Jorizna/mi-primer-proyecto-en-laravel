<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function store(Request $request, Movie $movie)
    {
        $request->validate([
            'score' => 'required|integer|min:1|max:5'
        ]);

        try {

            $rating = Rating::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'content_id' => $movie->id
                ],
                [
                    'score' => $request->score
                ]
            );

            $movie->updateAverageRating();

            return back()->with('success', 'Valoración guardada');

        } catch (\Exception $e) {

            return back()->with('error', 'Error al guardar valoración');
        }
    }

    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('content_id')
                ->constrained('movies')
                ->onDelete('cascade');


            $table->unsignedTinyInteger('score');


            $table->unique(['user_id', 'content_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};

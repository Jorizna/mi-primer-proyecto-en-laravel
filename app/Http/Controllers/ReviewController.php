<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReviewRequest;

class ReviewController extends Controller
{


    /**
     * Crear un nuevo comentario para una película
     */
    public function store(StoreReviewRequest $request, Movie $movie)
    {
        $review = new Review([
            'user_id' => Auth::id(),
            'content_id' => $movie->id,
            'title' => $request->input('title'),
            'content' => $request->input('content'), // ← usa input() en vez de ->content
        ]);

        $review->save();

        return redirect()->route('movies.show', $movie)->with('success', 'Comentario creado correctamente');
    }

    /**
     * Mostrar el formulario de edición de un comentario
     */
    public function edit(Review $review)
    {
        $this->authorizeReview($review);

        return view('reviews.edit', compact('review'));
    }

    /**
     * Actualizar comentario existente
     */
    public function update(StoreReviewRequest $request, Review $review)
    {
        $this->authorizeReview($review);

        $review->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);
        return redirect()->route('movies.show', $review->content_id)
            ->with('success', 'Comentario actualizado correctamente');
    }

    /**
     * Eliminar comentario
     */
    public function destroy(Review $review)
    {
        $this->authorizeReview($review);

        $movieId = $review->content_id;
        $review->delete();

        return redirect()->route('movies.show', $movieId)
            ->with('success', 'Comentario eliminado correctamente');
    }

    /**
     * Autorizar acción solo si es creador o admin
     */
    private function authorizeReview(Review $review)
    {
        if (Auth::id() !== $review->user_id && !Auth::user()->is_admin) {
            abort(403, 'No tienes permisos para modificar este comentario.');
        }
    }
}

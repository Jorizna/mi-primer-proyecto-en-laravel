<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReviewRequest;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, Movie $movie)
    {
        Review::create([
            'user_id' => Auth::id(),
            'content_id' => $movie->id,
            ...$request->validated(),
        ]);

        return redirect()->route('movies.show', $movie)->with('success', 'Comentario creado correctamente');
    }

    public function edit(Review $review)
    {
        $this->authorizeReview($review);
        return view('reviews.edit', compact('review'));
    }

    public function update(StoreReviewRequest $request, Review $review)
    {
        $this->authorizeReview($review);
        $review->update($request->validated());
        return redirect()->route('movies.show', $review->content_id)
            ->with('success', 'Comentario actualizado correctamente');
    }

    public function destroy(Review $review)
    {
        $this->authorizeReview($review);
        $movieId = $review->content_id;
        $review->delete();
        return redirect()->route('movies.show', $movieId)
            ->with('success', 'Comentario eliminado correctamente');
    }

    private function authorizeReview(Review $review)
    {
        if (Auth::id() !== $review->user_id && !Auth::user()->is_admin) {
            abort(403, 'No tienes permisos para modificar este comentario.');
        }
    }
}

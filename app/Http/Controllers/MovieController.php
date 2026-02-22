<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(15);
        return view('movies.index', compact('movies'));
    }

    public function home()
    {
        $movies = Movie::latest()->take(5)->get();
        return view('welcome', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(StoreMovieRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('movies', 'public');
        }

        $validated['user_id'] = auth()->id();

        Movie::create($validated);

        return redirect()
            ->route('movies.index')
            ->with('success', 'Película creada correctamente');
    }

    public function show(Movie $movie)
    {
        $userRating = auth()->check()
            ? $movie->ratings()->where('user_id', auth()->id())->first()
            : null;
        return view('movies.show', compact('movie', 'userRating'));
    }

    public function edit(Movie $movie)
    {
        $this->authorizeMovie($movie);
        return view('movies.edit', compact('movie'));
    }

    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $this->authorizeMovie($movie);

        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('movies', 'public');
        }

        $movie->update($data);

        return redirect()->route('movies.show', $movie)->with('success', 'Película actualizada');
    }

    public function destroy(Movie $movie)
    {
        $this->authorizeMovie($movie);

        $movie->delete();

        return redirect()->route('movies.index')
            ->with('success', 'Película eliminada correctamente');
    }

    public function mine()
    {
        $movies = Movie::where('user_id', auth()->id())->latest()->paginate(15);
        return view('movies.index', ['movies' => $movies, 'pageTitle' => 'Mis películas']);
    }

    private function authorizeMovie(Movie $movie)
    {
        if (auth()->id() !== $movie->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }
    }
}

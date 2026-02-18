<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
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
        return view('movies.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        // Autorización básica
        if (auth()->id() !== $movie->user_id) {
            abort(403);
        }

        return view('movies.edit', compact('movie'));
    }

    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        if (auth()->id() !== $movie->user_id) {
            abort(403);
        }

        $data = $request->validated();

        // Si hay nueva imagen
        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('movies', 'public');
        }

        $movie->update($data);

        return redirect()->route('movies.show', $movie)->with('success', 'Película actualizada');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('movies.index')
            ->with('success', 'Película eliminada correctamente');
    }
}

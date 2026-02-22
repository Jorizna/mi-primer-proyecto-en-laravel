<x-app-layout>
    <div class="page-container">

        <div class="welcome-header">
            <h1>{{ $pageTitle ?? 'Listado de películas' }}</h1>
            @auth
                <div style="display:flex; gap:.75rem; flex-wrap:wrap;">
                    <a href="{{ route('movies.create') }}" class="btn btn-primary">+ Nueva película</a>
                    @unless(request()->routeIs('movies.mine'))
                        <a href="{{ route('movies.mine') }}" class="btn btn-secondary">Mis películas</a>
                    @endunless
                </div>
            @endauth
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="movies-home-grid">
            @forelse ($movies as $movie)
                <div class="card movie-card">
                    @if ($movie->imagen)
                        <img src="{{ asset('storage/' . $movie->imagen) }}"
                             alt="{{ $movie->titulo }}"
                             class="movie-home-poster">
                    @else
                        <div class="movie-home-placeholder">Sin imagen</div>
                    @endif

                    <div class="movie-card-body">
                        <h2>
                            <a href="{{ route('movies.show', $movie) }}" class="movie-card-title">
                                {{ $movie->titulo }}
                            </a>
                            <span class="movie-year">({{ $movie->año_estreno ?? 'Sin año' }})</span>
                        </h2>
                        <p><strong>Director:</strong> {{ $movie->director }}</p>
                        <p><strong>Género:</strong> {{ $movie->genero }}</p>
                        <p><strong>Duración:</strong> {{ $movie->duracion ?? 'N/A' }} min</p>

                        <div class="movie-card-actions">
                            <a href="{{ route('movies.show', $movie) }}" class="btn btn-primary btn-sm">Ver más</a>
                            @auth
                                @if (auth()->id() == $movie->user_id || auth()->user()->is_admin)
                                    <a href="{{ route('movies.edit', $movie) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('movies.destroy', $movie) }}" method="POST"
                                          style="display:inline;"
                                          onsubmit="return confirm('¿Eliminar esta película?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="card" style="grid-column:1/-1; text-align:center; color:#6b7280;">
                    <p>No hay películas registradas todavía.</p>
                </div>
            @endforelse
        </div>

        <div class="pagination-wrap">
            {{ $movies->links() }}
        </div>
    </div>
</x-app-layout>

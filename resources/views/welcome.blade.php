<x-app-layout>

    @guest
        <div class="hero">
            <h1 class="hero-title">MovieApp</h1>
            <p class="hero-subtitle">Descubre, valora y comparte tus películas favoritas con la comunidad</p>
            <div class="hero-actions">
                <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-secondary">Registrarse gratis</a>
                @endif
            </div>
        </div>
    @endguest

    <div class="page-container">

        <div class="welcome-header">
            <h1>Últimas películas</h1>
            @auth
                <div style="display:flex; gap:.75rem; flex-wrap:wrap;">
                    <a href="{{ route('movies.create') }}" class="btn btn-primary">+ Añadir película</a>
                    <a href="{{ route('movies.index') }}" class="btn btn-secondary">Ver todas</a>
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
                        </h2>
                        <p>{{ $movie->director }} &middot; {{ $movie->año_estreno }}</p>
                        <p><strong>Género:</strong> {{ $movie->genero }}</p>
                        <div style="margin-top:.75rem;">
                            <a href="{{ route('movies.show', $movie) }}" class="btn btn-primary btn-sm">Ver más</a>
                            @auth
                                @if (auth()->id() == $movie->user_id || auth()->user()->is_admin)
                                    <a href="{{ route('movies.edit', $movie) }}" class="btn btn-warning btn-sm">Editar</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="card" style="grid-column:1/-1; text-align:center; color:#6b7280;">
                    <p>No hay películas registradas aún.
                        @auth
                            <a href="{{ route('movies.create') }}" class="auth-link">¡Añade la primera!</a>
                        @endauth
                    </p>
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>

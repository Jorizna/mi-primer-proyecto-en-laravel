<x-app-layout>
    <div class="page-container">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('home') }}" class="btn btn-secondary" style="margin-bottom:1rem;">Volver al inicio</a>

        <div class="card">
            <div class="movie-detail">
                <div class="movie-detail-img">
                    @if ($movie->imagen)
                        <img src="{{ asset('storage/' . $movie->imagen) }}" alt="{{ $movie->titulo }}">
                    @endif
                </div>
                <div class="movie-detail-body">
                    <h2>{{ $movie->titulo }}</h2>
                    <p><strong>Director:</strong> {{ $movie->director }}</p>
                    <p><strong>Año de estreno:</strong> {{ $movie->año_estreno }}</p>
                    <p><strong>Duración:</strong> {{ $movie->duracion }} min</p>
                    <p><strong>Género:</strong> {{ $movie->genero }}</p>
                    <p style="margin-top:1rem;"><strong>Sinopsis:</strong></p>
                    <p>{{ $movie->sinopsis }}</p>
                    <p><strong>Reparto:</strong> {{ $movie->reparto }}</p>
                    <p style="margin-top:1rem;">
                        <strong>Valoración promedio:</strong>
                        {{ $movie->averageRating() ?? 'Sin valoraciones' }}
                        ({{ $movie->ratings()->count() }} votos)
                    </p>

                    @auth
                        @if (auth()->id() == $movie->user_id || auth()->user()->is_admin)
                            <div style="margin-top:1rem;">
                                <a href="{{ route('movies.edit', $movie) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('movies.destroy', $movie) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        @click="if(!confirm('¿Seguro que quieres borrar?')) $event.preventDefault()">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        {{-- Valoración --}}
        @auth
            <div class="card">
                <h4>Valorar esta película</h4>
                @if ($userRating)
                    <p>Tu valoración actual: {{ $userRating->score }}</p>
                @endif
                <form method="POST" action="{{ route('movies.rating', $movie) }}">
                    @csrf
                    <div class="star-rating">
                        @for ($i = 5; $i >= 1; $i--)
                            <input type="radio" name="score" value="{{ $i }}" id="star{{ $i }}"
                                {{ $userRating && $userRating->score == $i ? 'checked' : '' }}>
                            <label for="star{{ $i }}">★</label>
                        @endfor
                    </div>
                    <button class="btn btn-primary" style="margin-top:.75rem;">Enviar valoración</button>
                </form>
            </div>
        @endauth

        {{-- Comentarios --}}
        <div class="card">
            <h4>Comentarios</h4>

            @forelse ($movie->reviews()->latestFirst()->get() as $review)
                <div class="review-item">
                    <strong>{{ $review->title ?: 'Sin título' }}</strong>
                    <p>{{ $review->content }}</p>
                    <div class="review-meta">
                        Por {{ $review->user->name }} · {{ $review->created_at->format('d/m/Y H:i') }}
                    </div>
                    @auth
                        @if (auth()->id() == $review->user_id || auth()->user()->is_admin)
                            <div style="margin-top:.5rem;">
                                <a href="{{ route('reviews.edit', $review) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('reviews.destroy', $review) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        @click="if(!confirm('¿Seguro que quieres eliminar?')) $event.preventDefault()">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            @empty
                <p>No hay comentarios todavía. Sé el primero en comentar.</p>
            @endforelse

            @auth
                <form action="{{ route('reviews.store', $movie) }}" method="POST" style="margin-top:1.5rem;">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Título (opcional)</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                        @error('title')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Comentario</label>
                        <textarea name="content" rows="3" class="form-control">{{ old('content') }}</textarea>
                        @error('content')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar comentario</button>
                </form>
            @else
                <p style="margin-top:1rem;">Debes <a href="{{ route('login') }}">iniciar sesión</a> para comentar.</p>
            @endauth
        </div>

    </div>
</x-app-layout>

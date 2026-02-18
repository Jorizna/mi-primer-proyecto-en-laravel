<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $movie->titulo }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .stars input[type="radio"] {
            display: none;
        }
        .stars label {
            font-size: 2rem;
            color: #ccc;
            cursor: pointer;
        }
        .stars input[type="radio"]:checked ~ label,
        .stars label:hover,
        .stars label:hover ~ label {
            color: gold;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">

    <a href="{{ route('home') }}" class="btn btn-secondary mb-3">Volver al inicio</a>

    <div class="card shadow">
        <div class="row g-0">

            {{-- Imagen --}}
            <div class="col-md-4">
                @if($movie->imagen)
                    <img src="{{ asset('storage/'.$movie->imagen) }}" class="img-fluid rounded-start" alt="{{ $movie->titulo }}">
                @else
                    <img src="https://via.placeholder.com/300x450?text=Sin+imagen" class="img-fluid rounded-start">
                @endif
            </div>

            {{-- Datos --}}
            <div class="col-md-8">
                <div class="card-body">
                    <h2 class="card-title">{{ $movie->titulo }}</h2>

                    <p><strong>Director:</strong> {{ $movie->director }}</p>
                    <p><strong>Año de estreno:</strong> {{ $movie->año_estreno }}</p>
                    <p><strong>Duración:</strong> {{ $movie->duracion }} min</p>
                    <p><strong>Género:</strong> {{ $movie->genero }}</p>

                    <p class="mt-3"><strong>Sinopsis:</strong></p>
                    <p>{{ $movie->sinopsis }}</p>

                    <p><strong>Reparto:</strong> {{ $movie->reparto }}</p>

                    {{-- Valoración promedio --}}
                    <p class="mt-3">
                        <strong>⭐ Valoración promedio:</strong>
                        {{ $movie->averageRating() ?? 'Sin valoraciones' }}
                    </p>
                    <p><strong>Total valoraciones:</strong> {{ $movie->ratings()->count() }}</p>

                    {{-- Botones solo creador o admin --}}
                    @auth
                        @if(auth()->id() == $movie->user_id || auth()->user()->is_admin)
                            <a href="{{ route('movies.edit', $movie) }}" class="btn btn-warning">✏ Editar</a>
                            <form action="{{ route('movies.destroy', $movie) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('¿Seguro que quieres borrar?')">
                                    🗑 Eliminar
                                </button>
                            </form>
                        @endif
                    @endauth

                </div>
            </div>
        </div>
    </div>

    {{-- Sección valoraciones --}}
    @auth
        <div class="card mt-4 p-3">
            <h4>Valorar esta película</h4>

            @php
                $userRating = $movie->ratings()->where('user_id', auth()->id())->first();
            @endphp

            @if($userRating)
                <p>Tu valoración actual: {{ $userRating->score }} </p>
            @endif

            <form method="POST" action="{{ route('movies.rating', $movie) }}">
                @csrf
                <div class="stars mb-2">
                    @for($i = 5; $i >= 1; $i--)
                        <input type="radio" name="score" value="{{ $i }}" id="star{{ $i }}" {{ $userRating && $userRating->score == $i ? 'checked' : '' }}>
                        <label for="star{{ $i }}">★</label>
                    @endfor
                </div>
                <button class="btn btn-primary mt-2">Enviar valoración</button>
            </form>
        </div>
    @endauth

    {{-- Sección comentarios --}}
    <div class="card mt-4 shadow p-3">
        <h4>💬 Comentarios</h4>

        @if($movie->reviews->count() > 0)
            <ul class="list-group list-group-flush">
                @foreach($movie->reviews()->latestFirst()->get() as $review)
                    <div class="card mb-2 p-2">
                        <strong>{{ $review->title ?: 'Sin título' }}</strong>
                        <p>{{ $review->content }}</p> <!-- Aquí solo mostramos el contenido real -->
                        <small class="text-muted">
                            Por {{ $review->user->name }} • {{ $review->created_at->format('d/m/Y H:i') }}
                        </small>

                        @auth
                            @if(auth()->id() == $review->user_id || auth()->user()->is_admin)
                                <div class="mt-1">
                                    <a href="{{ route('reviews.edit', $review) }}" class="btn btn-sm btn-warning">Editar</a>

                                    <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que quieres eliminar?')">Eliminar</button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                @endforeach
            </ul>
        @else
            <p class="text-muted mt-2">No hay comentarios todavía. Sé el primero en comentar.</p>
        @endif

        {{-- Formulario de nuevo comentario --}}
        @auth
            <form action="{{ route('reviews.store', $movie) }}" method="POST" class="mt-3">
                @csrf
                <div class="mb-2">
                    <label for="title" class="form-label">Título (opcional)</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                    @error('title')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="content" class="form-label">Comentario</label>
                    <textarea name="content" id="content" rows="3" class="form-control">{{ old('content') }}</textarea>
                    @error('content')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Enviar comentario</button>
            </form>
        @else
            <p class="text-muted mt-2">Debes <a href="{{ route('login') }}">iniciar sesión</a> para comentar.</p>
        @endauth

    </div>

</div>

</body>
</html>

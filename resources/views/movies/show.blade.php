<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $movie->titulo }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <a href="{{ route('movies.index') }}" class="btn btn-secondary mb-3">Volver al listado</a>

    <div class="card shadow">
        <div class="row g-0">

            {{-- Imagen --}}
            <div class="col-md-4">
                @if($movie->imagen)
                    <img src="{{ asset('storage/'.$movie->imagen) }}" class="img-fluid rounded-start"
                         alt="{{ $movie->titulo }}">
                @else
                    <img src="https://via.placeholder.com/300x450?text=Sin+imagen" class="img-fluid rounded-start"
                         alt="Sin imagen">
                @endif
            </div>

            {{-- Datos --}}
            <div class="col-md-8">
                <div class="card-body">
                    <h2 class="card-title">{{ $movie->titulo }}</h2>

                    <p><strong>Director:</strong> {{ $movie->director ?? 'No especificado' }}</p>
                    <p><strong>Año de estreno:</strong> {{ $movie->año_estreno ?? 'No especificado' }}</p>
                    <p><strong>Duración:</strong> {{ $movie->duracion ?? 'No especificada' }} min</p>
                    <p><strong>Género:</strong> {{ $movie->genero ?? 'No especificado' }}</p>

                    <p class="mt-3"><strong>Sinopsis:</strong></p>
                    <p>{{ $movie->sinopsis ?? 'Sin sinopsis' }}</p>

                    <p><strong>Reparto:</strong> {{ $movie->reparto ?? 'No especificado' }}</p>

                    {{-- Valoración promedio --}}
                    <p class="mt-3">
                        <strong>Valoración promedio:</strong>
                        {{ $movie->rating ?? 'Sin valoraciones' }}
                    </p>

                    {{-- Creador de la película --}}
                    <p><strong>Subida por:</strong> {{ $movie->user->name ?? 'Desconocido' }}</p>

                    {{-- Botones solo creador o admin --}}
                    @auth
                        @if(auth()->id() == $movie->user_id || auth()->user()->isAdmin())
                            <a href="{{ route('movies.edit', $movie) }}" class="btn btn-warning">Editar</a>

                            <form action="{{ route('movies.destroy', $movie) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('¿Seguro que quieres borrar?')">
                                    Eliminar
                                </button>
                            </form>
                        @endif
                    @endauth

                </div>
            </div>
        </div>
    </div>

    {{-- Sección valoraciones --}}
    <div class="card mt-4 shadow">
        <div class="card-body">
            <h4>Valoraciones</h4>
            <p>Aquí irán las valoraciones de los usuarios (pendiente implementar).</p>
        </div>
    </div>

    {{-- Sección comentarios --}}
    <div class="card mt-4 shadow">
        <div class="card-body">
            <h4>Comentarios</h4>
            <p>Aquí irán los comentarios de los usuarios (pendiente implementar).</p>
        </div>
    </div>

</div>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de {{ auth()->user()->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1>Perfil de {{ auth()->user()->name }}</h1>

    {{-- Información del usuario --}}
    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><strong>Rol:</strong> {{ auth()->user()->role }}</p>
        </div>
    </div>

    {{-- Contenido creado por el usuario --}}
    <h3>Películas creadas</h3>
    @if(auth()->user()->movies->count() > 0)
        <ul class="list-group">
            @foreach(auth()->user()->movies as $movie)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $movie->titulo }}
                    <a href="{{ route('movies.show', $movie) }}" class="btn btn-sm btn-primary">Ver</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>No has creado ninguna película aún.</p>
    @endif

    {{-- Botón editar perfil --}}
    <a href="#" class="btn btn-warning mt-3">Editar perfil (pendiente)</a>
</div>

</body>
</html>

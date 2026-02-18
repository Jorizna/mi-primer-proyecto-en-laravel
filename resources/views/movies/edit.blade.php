<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar {{ $movie->titulo }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2>✏ Editar película</h2>

    <a href="{{ route('movies.show', $movie) }}" class="btn btn-secondary mb-3">⬅ Volver</a>

    {{-- Errores --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('movies.update', $movie) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $movie->titulo) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Director</label>
            <input type="text" name="director" class="form-control" value="{{ old('director', $movie->director) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Año de estreno</label>
            <input type="number" name="año_estreno" class="form-control" value="{{ old('año_estreno', $movie->año_estreno) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Duración (minutos)</label>
            <input type="number" name="duracion" class="form-control" value="{{ old('duracion', $movie->duracion) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Género</label>
            <input type="text" name="genero" class="form-control" value="{{ old('genero', $movie->genero) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Sinopsis</label>
            <textarea name="sinopsis" class="form-control" rows="4">{{ old('sinopsis', $movie->sinopsis) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Reparto</label>
            <textarea name="reparto" class="form-control" rows="2">{{ old('reparto', $movie->reparto) }}</textarea>
        </div>

        {{-- Imagen actual --}}
        <div class="mb-3">
            <label class="form-label">Imagen actual</label><br>
            @if($movie->imagen)
                <img src="{{ asset('storage/'.$movie->imagen) }}" width="150" class="mb-2">
            @else
                <p>Sin imagen</p>
            @endif
        </div>

        {{-- Subir nueva imagen --}}
        <div class="mb-3">
            <label class="form-label">Cambiar imagen (opcional)</label>
            <input type="file" name="imagen" class="form-control">
        </div>

        <button class="btn btn-primary">Guardar cambios</button>
    </form>

</div>

</body>
</html>

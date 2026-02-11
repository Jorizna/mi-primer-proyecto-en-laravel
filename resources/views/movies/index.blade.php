<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Películas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; margin:0; padding:0; background:#f4f6f8; }
        header { background:#1f2937; color:white; padding:30px 20px; text-align:center; }
        header h1 { margin:0; }
        nav { text-align:center; margin-top:10px; }
        nav a { color:#e5e7eb; text-decoration:none; margin:0 10px; font-weight:bold; }
        nav a:hover { text-decoration:underline; }
        .container { max-width:1100px; margin:30px auto; padding:20px; background:white; border-radius:8px; }
        .card { border:1px solid #ddd; padding:15px; margin-bottom:15px; border-radius:5px; background:#fafafa; }
        .card h2 { margin:0 0 10px 0; }
        .btn { padding:8px 14px; border-radius:4px; text-decoration:none; font-size:14px; display:inline-block; margin-top:10px; }
        .btn-primary { background:#2563eb; color:white; }
        .pagination { margin-top:20px; text-align:center; }
    </style>
</head>
<body>

<header>
    <h1>Listado de Películas</h1>
    <nav>
        <a href="{{ route('home') }}">Inicio</a>
        <a href="{{ route('movies.create') }}">Crear nueva película</a>
    </nav>
</header>

<div class="container">

    @if ($movies->count() == 0)
        <p>No hay películas registradas.</p>
    @endif

    @foreach ($movies as $movie)
        <div class="card">
            <h2>{{ $movie->titulo }} ({{ $movie->año_estreno ?? 'Sin año' }})</h2>
            <p><strong>Director:</strong> {{ $movie->director }}</p>
            <p><strong>Género:</strong> {{ $movie->genero }}</p>
            <p><strong>Duración:</strong> {{ $movie->duracion ?? 'N/A' }} min</p>
            <a href="{{ route('movies.show', $movie) }}" class="btn btn-primary">Ver más</a>
        </div>
    @endforeach

    <div class="pagination">
        {{ $movies->links() }}
    </div>

</div>

</body>
</html>

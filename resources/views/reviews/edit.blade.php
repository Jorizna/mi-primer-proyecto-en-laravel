<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Comentario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <a href="{{ route('movies.show', $review->content_id) }}" class="btn btn-secondary mb-3">⬅ Volver a la película</a>

    <div class="card shadow p-4">
        <h2 class="mb-4">Editar Comentario</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reviews.update', $review) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Título (opcional)</label>
                <input type="text" name="title" id="title" class="form-control"
                       value="{{ old('title', $review->title) }}">
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Comentario</label>
                <textarea name="content" id="content" rows="5" class="form-control">{{ old('content', $review->content) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar comentario</button>
            <a href="{{ route('movies.show', $review->content_id) }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

</div>

</body>
</html>

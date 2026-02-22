<x-app-layout>
    <div class="page-container">
        <a href="{{ route('movies.show', $review->content_id) }}" class="btn btn-secondary" style="margin-bottom:1rem;">Volver a la película</a>

        <div class="card">
            <h2>Editar Comentario</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin:0;padding-left:1.25rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('reviews.update', $review) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label" for="title">Título (opcional)</label>
                    <input type="text" name="title" id="title" class="form-control"
                           value="{{ old('title', $review->title) }}">
                </div>

                <div class="form-group">
                    <label class="form-label" for="content">Comentario</label>
                    <textarea name="content" id="content" rows="5" class="form-control">{{ old('content', $review->content) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar comentario</button>
                <a href="{{ route('movies.show', $review->content_id) }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</x-app-layout>

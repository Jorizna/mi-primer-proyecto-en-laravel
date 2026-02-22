<x-app-layout>
    <div class="page-container">
        <h1>Editar película</h1>

        <a href="{{ route('movies.show', $movie) }}" class="btn btn-secondary" style="margin-bottom:1rem;">Volver</a>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin:0;padding-left:1.25rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <form action="{{ route('movies.update', $movie) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Título</label>
                    <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $movie->titulo) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Director</label>
                    <input type="text" name="director" class="form-control" value="{{ old('director', $movie->director) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Año de estreno</label>
                    <input type="number" name="año_estreno" class="form-control" value="{{ old('año_estreno', $movie->año_estreno) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Duración (minutos)</label>
                    <input type="number" name="duracion" class="form-control" value="{{ old('duracion', $movie->duracion) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Género</label>
                    <input type="text" name="genero" class="form-control" value="{{ old('genero', $movie->genero) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Sinopsis</label>
                    <textarea name="sinopsis" class="form-control" rows="4">{{ old('sinopsis', $movie->sinopsis) }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Reparto</label>
                    <textarea name="reparto" class="form-control" rows="2">{{ old('reparto', $movie->reparto) }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Imagen actual</label><br>
                    @if ($movie->imagen)
                        <img src="{{ asset('storage/' . $movie->imagen) }}" style="max-width:150px;margin-bottom:.5rem;border-radius:.375rem;">
                    @else
                        <p>Sin imagen</p>
                    @endif
                </div>

                <div class="form-group">
                    <label class="form-label">Cambiar imagen (opcional)</label>
                    <input type="file" name="imagen" class="form-control">
                </div>

                <button class="btn btn-primary">Guardar cambios</button>
            </form>
        </div>
    </div>
</x-app-layout>

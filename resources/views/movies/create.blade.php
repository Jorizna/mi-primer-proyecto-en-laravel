<x-app-layout>
    <div class="page-container">
        <h1>Crear nueva película</h1>

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
            <form method="POST" action="{{ route('movies.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="form-label">Título</label>
                    <input type="text" name="titulo" value="{{ old('titulo') }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Director</label>
                    <input type="text" name="director" value="{{ old('director') }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Año de estreno</label>
                    <input type="number" name="año_estreno" value="{{ old('año_estreno') }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Duración (minutos)</label>
                    <input type="number" name="duracion" value="{{ old('duracion') }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Género</label>
                    <input type="text" name="genero" value="{{ old('genero') }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Sinopsis</label>
                    <textarea name="sinopsis" rows="4" class="form-control">{{ old('sinopsis') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Reparto</label>
                    <textarea name="reparto" rows="2" class="form-control">{{ old('reparto') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Imagen (poster)</label>
                    <input type="file" name="imagen" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('movies.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</x-app-layout>

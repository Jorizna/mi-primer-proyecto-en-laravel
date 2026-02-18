<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Película</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded shadow">

    <h1 class="text-2xl font-bold mb-6">Crear nueva película</h1>

    <!-- Mostrar errores -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('movies.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Título -->
        <div class="mb-4">
            <label class="block font-semibold">Título</label>
            <input type="text" name="titulo" value="{{ old('titulo') }}"
                   class="w-full border p-2 rounded">
        </div>

        <!-- Director -->
        <div class="mb-4">
            <label class="block font-semibold">Director</label>
            <input type="text" name="director" value="{{ old('director') }}"
                   class="w-full border p-2 rounded">
        </div>

        <!-- Año de estreno -->
        <div class="mb-4">
            <label class="block font-semibold">Año de estreno</label>
            <input type="number" name="año_estreno" value="{{ old('año_estreno') }}"
                   class="w-full border p-2 rounded">
        </div>

        <!-- Duración -->
        <div class="mb-4">
            <label class="block font-semibold">Duración (minutos)</label>
            <input type="number" name="duracion" value="{{ old('duracion') }}"
                   class="w-full border p-2 rounded">
        </div>

        <!-- Género -->
        <div class="mb-4">
            <label class="block font-semibold">Género</label>
            <input type="text" name="genero" value="{{ old('genero') }}"
                   class="w-full border p-2 rounded">
        </div>

        <!-- Sinopsis -->
        <div class="mb-4">
            <label class="block font-semibold">Sinopsis</label>
            <textarea name="sinopsis" rows="4"
                      class="w-full border p-2 rounded">{{ old('sinopsis') }}</textarea>
        </div>

        <!-- Reparto -->
        <div class="mb-4">
            <label class="block font-semibold">Reparto</label>
            <textarea name="reparto" rows="2"
                      class="w-full border p-2 rounded">{{ old('reparto') }}</textarea>
        </div>

        <!-- Imagen -->
        <div class="mb-4">
            <label class="block font-semibold">Imagen (poster)</label>
            <input type="file" name="imagen"
                   class="w-full border p-2 rounded bg-white">
        </div>

        <!-- Botones -->
        <div class="flex gap-3">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Guardar
            </button>

            <a href="{{ route('movies.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Cancelar
            </a>
        </div>

    </form>

</div>

</body>
</html>

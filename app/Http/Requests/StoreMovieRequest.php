<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:255|unique:movies,titulo',
            'director' => 'required|string|max:255',
            'año_estreno' => 'nullable|integer|min:1900',
            'duracion' => 'nullable|integer|min:1',
            'genero' => 'nullable|string|max:255',
            'sinopsis' => 'nullable|string',
            'reparto' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.max' => 'El título no puede superar los 255 caracteres.',
            'titulo.unique' => 'Ya existe una película con ese título.',
            'director.required' => 'El director es obligatorio.',
            'director.max' => 'El nombre del director no puede superar los 255 caracteres.',
            'año_estreno.integer' => 'El año de estreno debe ser un número.',
            'año_estreno.min' => 'El año de estreno no puede ser menor a 1900.',
            'año_estreno.max' => 'El año de estreno no puede ser mayor al año actual.',
            'duracion.integer' => 'La duración debe ser un número.',
            'duracion.min' => 'La duración debe ser al menos 1 minuto.',
        ];
    }
}

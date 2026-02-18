<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() && auth()->id() == $this->movie->user_id;
    }

    public function rules()
    {
        return [
            'titulo' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'año_estreno' => 'required|integer|min:1900|max:' . date('Y'),
            'duracion' => 'required|integer|min:1',
            'genero' => 'required|string|max:100',
            'sinopsis' => 'required|string',
            'reparto' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'El usuario es obligatorio.',
            'user_id.exists'   => 'El usuario seleccionado no existe.',
            'titulo.required'  => 'El título es obligatorio.',
            'titulo.max'       => 'El título no puede superar los 255 caracteres.',
            'director.required'=> 'El director es obligatorio.',
            'director.max'     => 'El nombre del director no puede superar los 255 caracteres.',
            'año_estreno.integer' => 'El año de estreno debe ser un número.',
            'año_estreno.min'     => 'El año de estreno no puede ser menor a 1900.',
            'año_estreno.max'     => 'El año de estreno no puede ser mayor al año actual.',
            'duracion.integer'    => 'La duración debe ser un número.',
            'duracion.min'        => 'La duración debe ser al menos 1 minuto.',
        ];
    }
}

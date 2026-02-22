<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:100',
            'content' => 'required|string|min:10|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'title.max' => 'El título no puede superar los 100 caracteres.',
            'content.required' => 'El contenido del comentario es obligatorio.',
            'content.min' => 'El comentario debe tener al menos 10 caracteres.',
            'content.max' => 'El comentario no puede superar los 1000 caracteres.',
        ];
    }
}

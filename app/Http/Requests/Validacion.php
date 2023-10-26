<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Validacion extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           
                'nombre' => 'required|string|max:20',
                'descripcion' => 'required|string|max:255',  
                'precio' => 'required|numeric|min:0',           
           
        ];
    }

    public function messages()
{
    return [
        'nombre.required' => 'El campo nombre es obligatorio.',
        'descripcion.required' => 'El campo descripcion  es obligatorio.',
        'precio.required' => 'El campo precio es obligatorio.',
        // Agrega más mensajes personalizados según sea necesario.
    ];
}
}

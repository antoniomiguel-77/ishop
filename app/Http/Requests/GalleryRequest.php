<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {



        return [
           'images.*' => 'required|image|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'images.required' => 'Campo Obrigatório',
            'images.image' => 'Imagem invalida',
            'images.max' => 'maximo 5MB',
      
        ];
    }
}

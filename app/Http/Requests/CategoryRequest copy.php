<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {



        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($this?->category_id)
                    ->when(
                        $this->company_id,
                        fn($rule) =>
                        $rule->where(fn($query) => $query->where('company_id', $this->company_id))
                    ),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Campo Obrigatório',
            'name.string' => 'Deve ser uma string',
            'name.max' => 'Máximo de caracteres 255',
            'name.unique' => 'Já existe uma categoria com este nome',
        ];
    }
}

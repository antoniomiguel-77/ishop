<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
                'max:100',
                'min:3',
                Rule::unique('products', 'name')->ignore($this?->product_id)
                    ->when(
                        $this->company_id,
                        fn($rule) =>
                        $rule->where(fn($query) => $query->where('company_id', $this->company_id))
                    ),
            ],
            'type' => 'nullable|string|max:255',
            'price' => 'required',
            'tax' => 'required|numeric',
            'reason_id' => 'required_if:tax,0',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Campo brigatório.',
            'name.unique' => 'Este produto já existe.',
            'price.required' => 'Campo brigatório.',
            'name.string' => 'Deve ser uma string.',
            'name.max' => 'Não pode ter mais de 100 caracteres.',
            'name.min' => 'Deve ter pelo menos 3 caracteres.',
            'reason_id.required_if' => 'Deve informar o motivo de isenção se a taxa for zero.',
            'type.string' => 'Deve ser uma string.',
            'type.max' => 'Não pode ter mais de 255 caracteres.',
            'reason_id.exists' => 'O motivo selecionado não existe.',
            'tax.required' => 'Campo brigatório.',
            'category_id.required' => 'Campo brigatório.',
            'category_id.exists' => 'A categoria selecionada não existe.',

            'subcategory_id.required' => 'Campo brigatório.',
            'subcategory_id.exists' => 'A subcategoria selecionada não existe.',
        ];
    }
}

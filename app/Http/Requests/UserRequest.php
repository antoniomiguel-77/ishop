<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this?->user_id)
                    ->when(
                        $this->company_id,
                        fn($rule) =>
                        $rule->where(fn($query) => $query->where('company_id', $this->company_id))
                    ),
            ],
            'type' => 'required|min:1|required',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Campo brigatório.',
            'type.required' => 'Campo brigatório.',
            'email.unique' => 'Este email já existe.',
            'email.required' => 'Campo brigatório.',
            'email.email' => 'Informe um email válido.',

        ];
    }
}

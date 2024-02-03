<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CounterpartyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'required',
                'min:3',
                'max:25'
            ],
            'address' => [
                'string',
                'required',
                'min:3'
            ],
            'phone' => [
                'required',
                'unique:counterparties,phone',
                'min:9'
            ],
            'email' =>[
                'email',
                'required',
                'unique:counterparties,email'
            ],
            'roles' => ['required', 'array', Rule::exists('roles', 'id')],
        ];
    }
}

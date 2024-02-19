<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'lastname' => [''],
            'organization_id' => ['exists:organizations,id'],
            'login' => ['required', 'unique:users,login'],
            'password' => ['required'],
            'phone' => ['unique:users,phone'],
            'email' => ['nullable', 'email', 'unique:users,email'],
        ];
    }
}

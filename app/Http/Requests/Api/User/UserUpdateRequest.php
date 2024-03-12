<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'organization_id' => ['exists:organizations,id'],
            'login' => ['required', Rule::unique('users', 'login')->ignore($this->route()->user->id)],
            'password' => ['required'],
            'phone' => [Rule::unique('users', 'phone')->ignore($this->route()->user->id)],
            'email' => ['nullable', 'email', Rule::unique('users', 'email')->ignore($this->route()->user->id)],
            'image' => ['nullable', 'file'],
            'status' => ['boolean']
        ];
    }
}

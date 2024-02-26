<?php

namespace App\Http\Requests\Api\Storage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorageRequest extends FormRequest
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
            'employee_id' => ['required', Rule::exists('employees', 'id')],
            'organization_id' => ['required', Rule::exists('organizations', 'id')],
            'from' => ['required', 'date'],
            'to' => ['required', 'date']
        ];
    }
}

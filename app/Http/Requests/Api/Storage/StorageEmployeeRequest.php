<?php

namespace App\Http\Requests\Api\Storage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorageEmployeeRequest extends FormRequest
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
            'storage_data' => ['array', 'nullable'],
            'storage_data.*.employee_id' => ['nullable', Rule::exists('employees', 'id')],
            'storage_data.*.from' => ['nullable', 'date'],
            'storage_data.*.to' => ['nullable', 'date']
        ];
    }
}

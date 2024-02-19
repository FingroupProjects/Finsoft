<?php

namespace App\Http\Requests\Api\Good;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class GoodUpdateRequest extends FormRequest
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
            'id' => ['required'],
            'name' => ['required', 'string'],
            'vendor_code' => ['required', Rule::unique('goods')->ignore($this->id)],
            'description' => [''],
            'category_id' => ['required', 'exists:categories,id'],
            'unit_id' => ['required', 'exists:units,id'],
            'barcode' => ['required', Rule::unique('goods')->ignore($this->id)],
            'storage_id' => ['required', 'exists:storages,id'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ], 422);

        throw new HttpResponseException($response);
    }
}

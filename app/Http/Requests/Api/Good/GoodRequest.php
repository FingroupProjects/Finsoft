<?php

namespace App\Http\Requests\Api\Good;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class GoodRequest extends FormRequest
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
            'vendor_code' => ['required', 'unique:goods,vendor_code'],
            'description' => [''],
            'category_id' => ['required', 'exists:categories,id'],
            'unit_id' => ['required', 'exists:units,id'],
            'barcode' => ['nullable', 'unique:goods,barcode'],
            'storage_id' => ['required', 'exists:storages,id'],
            'good_group_id' => ['required', 'exists:good_groups,id'],
            'main_image' => ['nullable', 'file'],
            'add_images' => ['nullable', ''],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле наименование обязательно для заполнения.',
            'vendor_code.required' => 'Поле артикул обязательно для заполнения.',
            'phone.unique' => 'Такое значение поле телефон уже существует.',
            'email.required' => 'Поле почта обязательно для заполнения.',
            'email.unique' => 'Такое значение поле почта уже существует.',
            'address.required' => 'Поле адрес обязательно для заполнения.',
        ];
    }
}

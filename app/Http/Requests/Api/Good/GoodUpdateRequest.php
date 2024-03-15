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
            'vendor_code' => ['required', Rule::unique('goods')->ignore($this->route()->user->id)],
            'description' => [''],
            'category_id' => ['required', 'exists:categories,id'],
            'unit_id' => ['required', 'exists:units,id'],
            'barcode' => ['required', Rule::unique('goods')->ignore($this->route()->user->id)],
            'storage_id' => ['required', 'exists:storages,id'],
            'good_group_id' => ['required', 'exists:storages,id'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле наименование обязательно для заполнения.',
            'vendor_code.required' => 'Поле артикул обязательно для заполнения.',
            'category_id.required' => 'Поле категория обязательно для заполнения.',
            'category_id.exists' => 'Выбранное значение для категория не существует.',
            'unit_id.required' => 'Поле единица обязательно для заполнения.',
            'unit_id.exists' => 'Выбранное значение для единица не существует.',
            'storage_id.required' => 'Поле склад обязательно для заполнения.',
            'storage_id.exists' => 'Выбранное значение для склад не существует.',
            'good_group_id.required' => 'Поле группа номенклатур обязательно для заполнения.',
            'good_group_id.exists' => 'Выбранное значение для группа номенклатур не существует.',
        ];
    }
}

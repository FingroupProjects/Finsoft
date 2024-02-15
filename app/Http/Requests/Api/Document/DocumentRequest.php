<?php

namespace App\Http\Requests\Api\Document;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class DocumentRequest extends FormRequest
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
            'date' => ['required', 'date'],
            'counterparty_id' => ['required', 'exists:counterparties,id'],
            'counterparty_agreement_id' => ['required', 'exists:counterparty_agreements,id'],
            'organization_id' => ['required', 'exists:organizations,id'],
            'storage_id' => ['required', 'exists:storages,id'],
            'author_id' => ['required', 'exists:users,id'],
            'goods' => ['nullable', 'array'],
            'goods.*.good_id' => ['required', 'exists:goods,id'],
            'goods.*.amount' => ['required', 'min:1'],
            'goods.*.price' => ['required', 'float'],
        ];
    }

}

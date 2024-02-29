<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IdRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ids' => ['array', 'required', 'exists:counterparties,id']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

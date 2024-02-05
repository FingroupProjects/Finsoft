<?php

namespace App\Http\Requests\Api\CounterpartyAgreement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CounterpartyAgreementRequest extends FormRequest
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
            'name' => ['string', 'required'],
            'contract_number' => ['required', 'string'],
            'date' => ['required'],
            'organization_id' => ['required', Rule::exists('organizations', 'id')],
            'counterparty_id' => ['required', Rule::exists('counterparties', 'id')],
            'contact_person' => ['required'],
            'currency_id' => ['required', Rule::exists('currencies', 'id')],
            'payment_id' => ['required', Rule::exists('currencies', 'id')],
            'comment' => [''],
            'price_type_id' => ['required', Rule::exists('price_types', 'id')],


        ];
    }
}

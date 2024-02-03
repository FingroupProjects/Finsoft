<?php

namespace App\DTO;


use App\Http\Requests\Api\CurrencyRequest;
use App\Http\Requests\Api\OrganizationBillRequest;
use Illuminate\Auth\Events\Login;


class OrganizationBillDTO {

    public function __construct(public string $name, public int $organization_id, public string $currency_id, public string $bill_number){ }


    public static function fromRequest(OrganizationBillRequest $request) :OrganizationBillDTO {
        return new static(
            $request->get('name'),
            $request->get('organization_id'),
            $request->get('currency_id'),
            $request->get('bill_number')
        );
    }
}

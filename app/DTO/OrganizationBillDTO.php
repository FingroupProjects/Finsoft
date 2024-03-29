<?php

namespace App\DTO;

use App\Http\Requests\Api\OrganizationBill\OrganizationBillRequest;

class OrganizationBillDTO
{
    public function __construct(public string $name, public int $organization_id, public string $currency_id, public string $bill_number, public string $date, public ?string $comment)
    {
    }

    public static function fromRequest(OrganizationBillRequest $request) :self
    {
        return new static(
            $request->get('name'),
            $request->get('organization_id'),
            $request->get('currency_id'),
            $request->get('bill_number'),
            $request->get('date'),
            $request->get('comment'),
        );
    }
}

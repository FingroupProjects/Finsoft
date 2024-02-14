<?php

namespace App\DTO;

use Illuminate\Http\Request;


class CashRegisterDTO {

    public function __construct(public GoodDTO $good, public int $currency_id, public int $organization_id){ }


    public static function fromRequest(Request $request) :CashRegisterDTO {
        return new static(
            $request->get('name'),
            $request->get('currency_id'),
            $request->get('organization_id'),
        );
    }
}

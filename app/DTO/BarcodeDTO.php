<?php

namespace App\DTO;

use App\Http\Requests\Api\CashRegister\CashRegisterRequest;
use App\Http\Requests\Api\Group\GroupRequest;
use App\Http\Requests\BarcodeRequest;
use Illuminate\Http\Request;

class BarcodeDTO
{
    public function __construct(public string $barcode, public int $good_id)
    {
    }

    public static function fromRequest(BarcodeRequest $request) :self
    {
        return new static(
            $request->get('barcode'),
            $request->get('good_id')
        );
    }
}

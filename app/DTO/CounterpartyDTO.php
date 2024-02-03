<?php

namespace App\DTO;


use App\Http\Requests\Api\CounterpartyRequest;
use App\Http\Requests\Api\CurrencyRequest;
use App\Http\Requests\Api\OrganizationBillRequest;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;


class CounterpartyDTO {

    public function __construct(public string $name, public string $address, public string $phone, public string $email, public array $roles){ }


    public static function fromRequest(Request $request) :CounterpartyDTO {
        return new static(
            $request->get('name'),
            $request->get('address'),
            $request->get('phone'),
            $request->get('email'),
            $request->get('roles')
        );
    }
}

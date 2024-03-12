<?php

namespace App\DTO;

use App\Http\Requests\Api\Good\GoodRequest;

class GoodGroupDTO
{
    public function __construct(public string $name, public bool $is_good, public bool $is_service)
    {
    }

    public static function fromRequest(GoodRequest $request) :self
    {
        return new static(
            $request->get('name'),
            $request->get('is_good'),
            $request->get('is_service'),
        );
    }
}

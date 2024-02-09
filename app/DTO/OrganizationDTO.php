<?php

namespace App\DTO;

use Illuminate\Http\Request;

class OrganizationDTO
{
    public function __construct(public string $name) { }

    public static function fromRequest(Request $request) :OrganizationDTO
    {
        return new static(
            $request->get('name'),
        );
    }
}

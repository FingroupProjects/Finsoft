<?php

namespace App\DTO;

use App\Http\Requests\Api\Organization\OrganizationRequest;
use Illuminate\Http\Request;

class OrganizationDTO
{
    public function __construct(public string $name, public string $address, public string $description)
    {
    }

    public static function fromRequest(OrganizationRequest $request) :self
    {
        return new static(
            $request->get('name'),
            $request->get('address'),
            $request->get('description'),
        );
    }
}

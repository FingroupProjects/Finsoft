<?php

namespace App\DTO;

use App\Http\Requests\Api\Storage\StorageRequest;

class StorageDTO
{
    public function __construct(public string $name, public int $employee_id, public int $organization_id, public string $from, public string $to)
    {
    }

    public static function fromRequest(StorageRequest $request) :self
    {
        return new static(
            $request->get('name'),
            $request->get('employee_id'),
            $request->get('organization_id'),
            $request->get('from'),
            $request->get('to'),
        );
    }
}

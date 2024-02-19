<?php

namespace App\DTO;

use App\Http\Requests\Api\Storage\StorageRequest;

class StorageDTO
{
    public function __construct(public string $name, public int $employee_id)
    {
    }

    public static function fromRequest(StorageRequest $request) :self
    {
        return new static(
            $request->get('name'),
            $request->get('employee_id'),
        );
    }
}

<?php

namespace App\DTO;

use App\Http\Requests\Api\Storage\StorageEmployeeRequest;
use App\Http\Requests\Api\Storage\StorageRequest;

class StorageEmployeeDTO
{
    public function __construct(public array $storage_data)
    {
    }

    public static function fromRequest(StorageEmployeeRequest $request) :self
    {
        return new static(
            $request->get('storage_data'),
        );
    }
}

<?php

namespace App\DTO;

use App\Http\Requests\Api\Employee\EmployeeRequest;
use Illuminate\Http\UploadedFile;

class EmployeeDTO
{
    public function __construct(public string $name, public string $surname, public string $lastname, public ?UploadedFile $image, public int $position_id)
    {
    }

    public static function fromRequest(EmployeeRequest $request) :self
    {
        return new static(
            $request->get('name'),
            $request->get('surname'),
            $request->get('lastname'),
            $request->file('image'),
            $request->get('position_id')
        );
    }
}

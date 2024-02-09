<?php

namespace App\DTO;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;


class EmployeeDTO {

    public function __construct(public string $name, public string $surname, public string $lastname, public UploadedFile $image){ }

    public static function fromRequest(Request $request) :EmployeeDTO {
        return new static(
            $request->get('name'),
            $request->get('surname'),
            $request->get('lastname'),
            $request->get('image'),
        );
    }
}

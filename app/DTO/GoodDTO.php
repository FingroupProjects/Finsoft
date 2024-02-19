<?php

namespace App\DTO;

use App\Http\Requests\Api\Good\GoodRequest;

class GoodDTO
{
    public function __construct(public string $name, public string $vendor_code, public string $description,
               public int $category_id, public int $unit_id, public string $barcode, public int $storage_id, public array $images)
    {
    }

    public static function fromRequest(GoodRequest $request) :self
    {
        return new static(
            $request->get('name'),
            $request->get('vendor_code'),
            $request->get('description'),
            $request->get('category_id'),
            $request->get('unit_id'),
            $request->get('barcode'),
            $request->get('storage_id'),
            $request->get('images'),
        );
    }
}

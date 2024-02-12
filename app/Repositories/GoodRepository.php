<?php

namespace App\Repositories;

use App\DTO\GoodDTO;
use App\DTO\GoodUpdateDTO;
use App\Models\Good;
use App\Repositories\Contracts\GoodRepositoryInterface;
use Illuminate\Support\Collection;

class GoodRepository implements GoodRepositoryInterface
{

    public function index(): Collection
    {
        return Good::get();
    }

    public function store(GoodDTO $DTO)
    {
        return Good::create([
            'name' => $DTO->name,
            'vendor_code' => $DTO->vendor_code,
            'description' => $DTO->description,
            'category_id' => $DTO->category_id,
            'unit_id' => $DTO->unit_id,
            'barcode' => $DTO->barcode,
            'storage_id' => $DTO->storage_id
        ]);

    }

    public function update(Good $good, GoodUpdateDTO $DTO): Good
    {
        $good->update([
            'name' => $DTO->name,
            'vendor_code' => $DTO->vendor_code,
            'description' => $DTO->description,
            'category_id' => $DTO->category_id,
            'unit_id' => $DTO->unit_id,
            'barcode' => $DTO->barcode,
            'storage_id' => $DTO->storage_id
        ]);

        return $good;
    }
}

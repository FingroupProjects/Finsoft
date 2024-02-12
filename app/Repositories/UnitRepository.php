<?php

namespace App\Repositories;

use App\DTO\OrganizationDTO;
use App\DTO\UnitDTO;
use App\Models\Organization;
use App\Models\Unit;
use App\Repositories\Contracts\UnitRepositoryInterface;
use Illuminate\Support\Collection;

class UnitRepository implements UnitRepositoryInterface
{
    public function index() :Collection
    {
        return Unit::get();
    }

    public function store(UnitDTO $DTO)
    {
        return Unit::create([
            'name' => $DTO->name,
        ]);
    }

    public function update(Unit $unit, UnitDTO $DTO) :Unit
    {
        $unit->update([
            'name' => $DTO->name,
        ]);

        return $unit;
    }
}

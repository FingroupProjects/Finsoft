<?php

namespace App\Repositories\Contracts;

use App\DTO\OrganizationDTO;
use App\DTO\UnitDTO;
use App\Models\Organization;
use App\Models\Unit;
use Illuminate\Support\Collection;

interface UnitRepositoryInterface
{
    public function index() :Collection;

    public function store(UnitDTO $DTO);

    public function update(Unit $unit, UnitDTO $DTO) :Unit;
}

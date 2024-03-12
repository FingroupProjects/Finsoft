<?php

namespace App\Repositories\Contracts;

use App\DTO\GoodDTO;
use App\DTO\GoodGroupDTO;
use App\DTO\GoodUpdateDTO;
use App\Models\Good;
use Illuminate\Support\Collection;

interface GoodGroupRepositoryInterface
{
    public function store(GoodGroupDTO $DTO);
}

<?php

namespace App\Repositories\Contracts;

use App\DTO\GoodDTO;
use App\DTO\GoodUpdateDTO;
use App\Models\Good;
use Illuminate\Support\Collection;

interface GoodRepositoryInterface extends IndexInterface
{
    public function store(GoodDTO $DTO);

    public function update(Good $good, GoodUpdateDTO $DTO) :Good;
}

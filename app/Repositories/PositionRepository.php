<?php

namespace App\Repositories;

use App\DTO\PositionDTO;
use App\Models\Position;
use App\Repositories\Contracts\PositionRepositoryInterface;

class PositionRepository implements PositionRepositoryInterface {


    public function store(PositionDTO $DTO)
    {
        return Position::create([
            'name' => $DTO->name,
        ]);
    }

    public function update(Position $position, PositionDTO $DTO): Position
    {
        $position->update([
            'name' => $DTO->name,
        ]);

        return $position;
    }
}

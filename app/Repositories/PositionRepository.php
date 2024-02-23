<?php

namespace App\Repositories;

use App\DTO\PositionDTO;
use App\Models\Position;
use App\Repositories\Contracts\PositionRepositoryInterface;
use App\Traits\FilterTrait;
use App\Traits\ValidFields;
use Illuminate\Pagination\LengthAwarePaginator;

class PositionRepository implements PositionRepositoryInterface
{
    use FilterTrait, ValidFields;

    public $model = Position::class;

    public function store(PositionDTO $DTO)
    {
        return $this->model::create([
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

    public function index(array $data): LengthAwarePaginator
    {
        $filterParams = $this->processSearchData($data);

        $query = $this->model::search($filterParams['search']);

        $query = $this->sort($filteredParams, $query, []);


        return $query->paginate($filterParams['itemsPerPage']);
    }

}

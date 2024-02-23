<?php

namespace App\Repositories;

use App\DTO\CashRegisterDTO;
use App\DTO\StorageDTO;
use App\Models\CashRegister;
use App\Models\Storage;
use App\Repositories\Contracts\CashRegisterRepositoryInterface;
use App\Repositories\Contracts\StorageRepositoryInterface;
use App\Traits\FilterTrait;
use App\Traits\ValidFields;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class StorageRepository implements StorageRepositoryInterface
{
    use ValidFields, FilterTrait;

    public $model = Storage::class;

    public function index(array $data): LengthAwarePaginator
    {
        $filterParams = $this->processSearchData($data);

        $query = $this->model::search($filterParams['search']);

        $query = $this->sort($filterParams, $query, ['employee']);

        return $query->paginate($filterParams['itemsPerPage']);
    }


    public function store(StorageDTO $DTO)
    {
        return Storage::create([
            'name' => $DTO->name,
            'employee_id' => $DTO->employee_id,
        ]);
    }

    public function update(Storage $storage, StorageDTO $DTO): Storage
    {
        $storage->update([
            'name' => $DTO->name,
            'employee_id' => $DTO->employee_id,
        ]);

        return $storage;
    }
}

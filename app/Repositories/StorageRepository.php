<?php

namespace App\Repositories;

use App\DTO\CashRegisterDTO;
use App\DTO\StorageDTO;
use App\Models\CashRegister;
use App\Models\Storage;
use App\Repositories\Contracts\CashRegisterRepositoryInterface;
use App\Repositories\Contracts\StorageRepositoryInterface;
use Illuminate\Support\Collection;

class StorageRepository implements StorageRepositoryInterface
{

    public function index(): Collection
    {
        return Storage::get();
    }

    public function store(StorageDTO $DTO)
    {
        return Storage::create([
           'name' => $DTO->name,
           'employee_id' => $DTO->employee_id
       ]);

    }

    public function update(Storage $storage, StorageDTO $DTO): Storage
    {
        $storage->update([
            'name' => $DTO->name,
            'employee_id' => $DTO->employee_id
        ]);

        return $storage;
    }
}

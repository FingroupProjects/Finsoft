<?php

namespace App\Repositories\Contracts;

use App\DTO\StorageDTO;
use App\DTO\StorageUpdateDTO;
use App\Models\Storage;

interface StorageRepositoryInterface extends IndexInterface
{
    public function store(StorageDTO $DTO);

    public function update(Storage $cashRegister, StorageUpdateDTO $DTO) :Storage;

    public function getEmployeesByStorageId(Storage $storage, array $data);
}

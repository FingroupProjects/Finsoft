<?php

namespace App\Repositories\Contracts;

use App\DTO\CashRegisterDTO;
use App\DTO\StorageDTO;
use App\Models\CashRegister;
use App\Models\Storage;
use Illuminate\Support\Collection;

interface StorageRepositoryInterface extends IndexInterface
{

    public function store(StorageDTO $DTO);

    public function update(Storage $cashRegister, StorageDTO $DTO) :Storage;

    public function getEmployeesByStorageId(Storage $storage);
}

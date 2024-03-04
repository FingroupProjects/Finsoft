<?php

namespace App\Repositories;

use App\DTO\CashRegisterDTO;
use App\DTO\StorageDTO;
use App\Models\CashRegister;
use App\Models\EmployeeStorage;
use App\Models\Storage;
use App\Repositories\Contracts\CashRegisterRepositoryInterface;
use App\Repositories\Contracts\StorageRepositoryInterface;
use App\Traits\FilterTrait;
use App\Traits\Sort;
use Carbon\Carbon;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StorageRepository implements StorageRepositoryInterface
{
    use Sort, FilterTrait;

    public $model = Storage::class;

    public function index(array $data): LengthAwarePaginator
    {
        $filterParams = $this->processSearchData($data);

        $query = $this->model::search($filterParams['search']);

        $query = $this->sort($filterParams, $query);


        return $query->paginate($filterParams['itemsPerPage']);
    }


    public function store(StorageDTO $DTO)
    {
        try {
            DB::transaction(function () use ($DTO) {
                $storage = Storage::create([
                    'name' => $DTO->name,
                    'organization_id' => $DTO->organization_id,
                    'group_id' => $DTO->group_id
                ]);

                EmployeeStorage::insert($this->storageData($DTO->storage_data, $storage));

            });
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Storage $storage, StorageDTO $DTO): Storage
    {
//        try {
//            DB::transaction(function () use ($storage, $DTO) {
//                $storage->update([
//                    'name' => $DTO->name,
//                    'employee_id' => $DTO->employee_id,
//                ]);
//
//                EmployeeStorage::create([
//                    'storage_id' => $storage->id,
//                    'employee_id' => $DTO->employee_id,
//                    'organization_id' => $DTO->organization_id,
//                    'from' => $DTO->from,
//                    'to' => $DTO->to
//                ]);
//            });
//        } catch (Exception $e) {
//            dd($e->getMessage());
//        }

        return $storage;
    }

    public function storageData(array $storage_data, Storage $storage): array
    {
        return array_map(function ($item) use ($storage) {
            return [
                'storage_id' => $storage->id,
                'employee_id' => $item['employee_id'],
                'from' => $item['from'],
                'to' => $item['to'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }, $storage_data);
    }
}

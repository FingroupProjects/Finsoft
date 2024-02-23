<?php

namespace App\Repositories;

use App\DTO\CashRegisterDTO;
use App\DTO\DocumentDTO;
use App\Models\CashRegister;
use App\Repositories\Contracts\CashRegisterRepositoryInterface;
use App\Traits\FilterTrait;
use App\Traits\ValidFields;
use Illuminate\Pagination\LengthAwarePaginator;
use function PHPUnit\Framework\isFalse;

class CashRegisterRepository implements CashRegisterRepositoryInterface
{
    use ValidFields, FilterTrait;

    public $model = CashRegister::class;

    public function index(array $data): LengthAwarePaginator
    {
        $filterParams = $this->processSearchData($data);


        $query = CashRegister::search($filterParams['search']);

        $query = $this->sort($filterParams, $query, ['organization', 'currency']);

        return $query->paginate($filterParams['itemsPerPage']);
    }

    public function store(CashRegisterDTO $DTO)
    {
        $this->model::create([
            'name' => $DTO->name,
            'currency_id' => $DTO->currency_id,
            'organization_id' => $DTO->organization_id,
        ]);
    }

    public function update(CashRegister $cashRegister, CashRegisterDTO $DTO): CashRegister
    {
        $cashRegister->update([
            'name' => $DTO->name,
            'currency_id' => $DTO->currency_id,
            'organization_id' => $DTO->organization_id,
        ]);

        return $cashRegister->load(['currency', 'organization']);
    }
}

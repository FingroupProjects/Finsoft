<?php

namespace App\Repositories;

use App\DTO\CashRegisterDTO;
use App\Models\CashRegister;
use App\Repositories\Contracts\CashRegisterRepositoryInterface;
use App\Traits\FilterTrait;
use App\Traits\ValidFields;
use Illuminate\Pagination\LengthAwarePaginator;
use function PHPUnit\Framework\isFalse;

class CashRegisterRepository implements CashRegisterRepositoryInterface
{
    use ValidFields, FilterTrait;

    const ON_PAGE = 10;

    public $model = CashRegister::class;

    public function index(array $data): LengthAwarePaginator
    {
        $filterParams = $this->processSearchData($data);

        $query = CashRegister::search($filterParams['search'])->query(function ($query) {
            $query->with(['currency', 'organization']);
        });

        if (! is_null($filterParams['orderBy']) && $this->isValidField($filterParams['orderBy'])) {
            $query->orderBy($filterParams['orderBy'], $filterParams['direction']);
        }

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

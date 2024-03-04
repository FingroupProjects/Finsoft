<?php

namespace App\Repositories;

use App\DTO\CashRegisterDTO;
use App\DTO\DocumentDTO;
use App\Models\CashRegister;
use App\Repositories\Contracts\CashRegisterRepositoryInterface;
use App\Repositories\Contracts\IndexInterface;
use App\Traits\FilterTrait;
use App\Traits\Sort;
use Cassandra\Index;
use Illuminate\Pagination\LengthAwarePaginator;
use function PHPUnit\Framework\isFalse;

class CashRegisterRepository implements CashRegisterRepositoryInterface
{
    use Sort, FilterTrait;

    public $model = CashRegister::class;

    public function index(array $data): LengthAwarePaginator
    {
        $filterParams = $this->processSearchData($data);

        $query = CashRegister::search($filterParams['search']);

        $query = $this->sort($filterParams, $query, ['organization', 'currency', 'responsiblePerson']);

        return $query->paginate($filterParams['itemsPerPage']);
    }

    public function store(CashRegisterDTO $DTO)
    {
        $this->model::create([
            'name' => $DTO->name,
            'currency_id' => $DTO->currency_id,
            'organization_id' => $DTO->organization_id,
            'responsible_person_id' => $DTO->responsible_person_id
        ]);
    }

    public function update(CashRegister $cashRegister, CashRegisterDTO $DTO): CashRegister
    {
        $cashRegister->update([
            'name' => $DTO->name,
            'currency_id' => $DTO->currency_id,
            'organization_id' => $DTO->organization_id,
            'responsible_person_id' => $DTO->responsible_person_id
        ]);

        return $cashRegister->load(['currency', 'organization', 'responsiblePerson']);
    }
}

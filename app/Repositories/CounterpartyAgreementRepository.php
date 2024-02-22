<?php

namespace App\Repositories;

use App\DTO\CounterpartyAgreementDTO;
use App\Models\Counterparty;
use App\Models\CounterpartyAgreement;
use App\Repositories\Contracts\CounterpartyAgreementRepositoryInterface;
use App\Traits\FilterTrait;
use App\Traits\ValidFields;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CounterpartyAgreementRepository implements CounterpartyAgreementRepositoryInterface
{
    use ValidFields, FilterTrait;

    public $model = CounterpartyAgreement::class;

    public const ON_PAGE = 10;

    public function index(array $data): LengthAwarePaginator
    {
        $filteredParams = $this->processSearchData($data);

        $query = $this->model::search($filteredParams['search'])->query(function ($query){
            $query->with(['organization', 'counterparty', 'currency', 'payment', 'priceType']);
        });

        if (! is_null($filteredParams['orderBy']) && $this->isValidField($filteredParams['orderBy'])) {
            $query->orderBy($filteredParams['orderBy'], $filteredParams['direction']);
        }

        return $query->paginate($filteredParams['itemsPerPage']);
    }

    public function store(CounterpartyAgreementDTO $DTO)
    {
        CounterpartyAgreement::create([
            'name' => $DTO->name,
            'contract_number' => $DTO->contract_number,
            'date' => Carbon::parse($DTO->date),
            'organization_id' => $DTO->organization_id,
            'counterparty_id' => $DTO->counterparty_id,
            'contact_person' => $DTO->contact_person,
            'currency_id' => $DTO->currency_id,
            'payment_id' => $DTO->payment_id,
            'comment' => $DTO->comment,
            'price_type_id' => $DTO->price_type_id,
        ]);
    }

    public function update(CounterpartyAgreement $counterpartyAgreement, CounterpartyAgreementDTO $DTO): CounterpartyAgreement
    {
        $counterpartyAgreement->update([
            'name' => $DTO->name,
            'contract_number' => $DTO->contract_number,
            'date' => $DTO->date,
            'organization_id' => $DTO->organization_id,
            'counterparty_id' => $DTO->counterparty_id,
            'contact_person' => $DTO->contact_person,
            'currency_id' => $DTO->currency_id,
            'payment_id' => $DTO->payment_id,
            'comment' => $DTO->comment,
            'price_type_id' => $DTO->price_type_id,
        ]);

        return $counterpartyAgreement->load(['organization', 'counterparty', 'currency', 'payment', 'priceType']);
    }

    public function getAgreementByCounterpartyId(Counterparty $counterparty, array $data): LengthAwarePaginator
    {
        $filteredParams = $this->processSearchData($data);

        $query = $this->model::search($filteredParams['search'])->query(function ($query) use ($counterparty){
            $query->where('counterparty_id', $counterparty->id)->with(['organization', 'counterparty', 'currency', 'payment', 'priceType']);
        });

        if (! is_null($filteredParams['orderBy']) && $this->isValidField($filteredParams['orderBy'])) {
            $query->orderBy($filteredParams['orderBy'], $filteredParams['direction']);
        }

        return $query->paginate($filteredParams['itemsPerPage']);
    }



}

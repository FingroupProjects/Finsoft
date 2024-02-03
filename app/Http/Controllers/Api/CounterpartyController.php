<?php

namespace App\Http\Controllers\Api;

use App\DTO\CounterpartyDTO;
use App\DTO\CurrencyDTO;
use App\DTO\ExchangeRateDTO;
use App\DTO\PriceTypeDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CounterpartyRequest;
use App\Http\Requests\Api\CounterpartyUpdateRequest;
use App\Http\Requests\Api\CurrencyRequest;
use App\Http\Requests\Api\ExchangeRequest;
use App\Http\Requests\Api\PriceTypeRequest;
use App\Http\Resources\CounterpartyResource;
use App\Http\Resources\CurrencyResource;
use App\Http\Resources\ExchangeRateResource;
use App\Http\Resources\PriceTypeResource;
use App\Models\Counterparty;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\PriceType;
use App\Repositories\Contracts\CounterpartyRepositoryInterface;
use App\Repositories\Contracts\CurrencyRepositoryInterface;
use App\Repositories\Contracts\PriceTypeRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psy\Util\Json;

class CounterpartyController extends Controller
{
    use ApiResponse;

    public function __construct(public CounterpartyRepositoryInterface $repository){ }

    public function index() :JsonResponse
    {
        return $this->success(CounterpartyResource::collection($this->repository->index()));
    }

    public function store(CounterpartyRequest $request) :JsonResponse
    {
       return $this->created($this->repository->store(CounterpartyDTO::fromRequest($request)));
    }

    public function update(Counterparty $counterparty, CounterpartyUpdateRequest $request) :JsonResponse
    {
        return $this->success(CounterpartyResource::make($this->repository->update($counterparty,  CounterpartyDTO::fromRequest($request))));
    }

}

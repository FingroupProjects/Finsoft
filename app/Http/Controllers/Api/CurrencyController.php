<?php

namespace App\Http\Controllers\Api;

use App\DTO\CurrencyDTO;
use App\DTO\ExchangeRateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CurrencyRequest;
use App\Http\Requests\Api\ExchangeRequest;
use App\Http\Requests\Api\IndexRequest;
use App\Http\Resources\CurrencyResource;
use App\Http\Resources\ExchangeRateResource;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Repositories\Contracts\CurrencyRepositoryInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psy\Util\Json;

class CurrencyController extends Controller
{
    use ApiResponse;

    public function __construct(public CurrencyRepositoryInterface $repository){ }

    public function index(IndexRequest $request) :JsonResponse
    {
        return $this->paginate(CurrencyResource::collection($this->repository->index($request->validated())));
    }

    public function store(CurrencyRequest $request) :JsonResponse
    {
       return $this->created(CurrencyResource::make($this->repository->store(CurrencyDTO::fromRequest($request))));
    }

    public function update(Currency $currency, CurrencyRequest $request) :JsonResponse
    {
        return $this->success(CurrencyResource::make($this->repository->update($currency,  CurrencyDTO::fromRequest($request))));
    }

    public function addExchangeRate(Currency $currency, ExchangeRequest $request) :JsonResponse
    {
        return $this->created($this->repository->addExchangeRate($currency, ExchangeRateDTO::fromRequest($request)));
    }

    public function removeExchangeRate(ExchangeRate $exchangeRate) :JsonResponse
    {
        return $this->success($exchangeRate->delete());
    }

    public function updateExchange(ExchangeRate $exchangeRate, ExchangeRequest $request) :JsonResponse
    {
        return $this->success(ExchangeRateResource::make($this->repository->updateExchangeRate($exchangeRate, ExchangeRateDTO::fromRequest($request))));
    }

    public function getExchangeRateByCurrencyId(Currency $currency) :JsonResponse
    {
        return $this->success(ExchangeRateResource::make($this->repository->getCurrencyExchangeRateByCurrencyRate($currency)));
    }

    public function delete(Currency $currency) :JsonResponse
    {
        return $this->success($this->repository->delete($currency));
    }


}

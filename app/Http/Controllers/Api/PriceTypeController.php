<?php

namespace App\Http\Controllers\Api;

use App\DTO\CurrencyDTO;
use App\DTO\ExchangeRateDTO;
use App\DTO\PriceTypeDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CurrencyRequest;
use App\Http\Requests\Api\ExchangeRequest;
use App\Http\Requests\Api\PriceTypeRequest;
use App\Http\Resources\CurrencyResource;
use App\Http\Resources\ExchangeRateResource;
use App\Http\Resources\PriceTypeResource;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\PriceType;
use App\Repositories\Contracts\CurrencyRepositoryInterface;
use App\Repositories\Contracts\PriceTypeRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psy\Util\Json;

class PriceTypeController extends Controller
{
    use ApiResponse;

    public function __construct(public PriceTypeRepository $repository){ }

    public function index() :JsonResponse
    {
        return $this->success(PriceTypeResource::collection(PriceType::get()));
    }

    public function store(PriceTypeRequest $request) :JsonResponse
    {
       return $this->created($this->repository->store(PriceTypeDTO::fromRequest($request)));
    }

    public function update(PriceType $priceType, PriceTypeRequest $request) :JsonResponse
    {
        return $this->success(PriceTypeResource::make($this->repository->update($priceType,  PriceTypeDTO::fromRequest($request))));
    }

    public function delete(PriceType $priceType) :JsonResponse
    {
        return $this->deleted($priceType->delete());
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\DTO\CurrencyDTO;
use App\DTO\ExchangeRateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CurrencyRequest;
use App\Http\Requests\Api\ExchangeRequest;
use App\Http\Requests\Api\IndexRequest;
use App\Http\Requests\IdRequest;
use App\Http\Resources\CurrencyResource;
use App\Http\Resources\ExchangeRateResource;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Repositories\Contracts\CurrencyRepositoryInterface;
use App\Repositories\Contracts\ExchangeRateInterface;
use App\Repositories\Contracts\MassDeleteInterface;
use App\Repositories\Contracts\MassOperationInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psy\Util\Json;

class ExchangeRateController extends Controller
{
    use ApiResponse;

    public function __construct(public ExchangeRateInterface $repository)
    {
    }

    public function index(IndexRequest $request, Currency $currency) :JsonResponse
    {
        return $this->paginate(ExchangeRateResource::collection($this->repository->index($currency, $request->validated())));
    }


    public function massDelete(IdRequest $request, MassOperationInterface $delete)
    {
        return $delete->massDelete(new ExchangeRate(), $request->validated());
    }
}

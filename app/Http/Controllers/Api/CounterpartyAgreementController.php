<?php

namespace App\Http\Controllers\Api;

use App\DTO\CounterpartyAgreementDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CounterpartyAgreement\CounterpartyAgreementRequest;
use App\Http\Requests\Api\CounterpartyAgreement\CounterpartyAgreementUpdateRequest;
use App\Http\Requests\Api\IndexRequest;
use App\Http\Resources\CounterpartyAgreementResource;
use App\Models\Counterparty;
use App\Models\CounterpartyAgreement;
use App\Repositories\Contracts\CounterpartyAgreementRepositoryInterface;
use App\Repositories\CounterpartyAgreementRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class CounterpartyAgreementController extends Controller
{
    use ApiResponse;

    public function __construct(public CounterpartyAgreementRepositoryInterface $repository)
    {
    }

    public function index() :JsonResponse
    {
        return $this->success(CounterpartyAgreementResource::collection($this->repository->index()));
    }

    public function show(CounterpartyAgreement $counterpartyAgreement) :JsonResponse
    {
        return $this->success(CounterpartyAgreementResource::make($counterpartyAgreement));
    }

    public function store(CounterpartyAgreementRequest $request) :JsonResponse
    {
        return $this->created($this->repository->store(CounterpartyAgreementDTO::fromRequest($request)));
    }

    public function update(CounterpartyAgreement $counterpartyAgreement, CounterpartyAgreementUpdateRequest $request) :JsonResponse
    {
        return $this->success(CounterpartyAgreementResource::make($this->repository->update($counterpartyAgreement, CounterpartyAgreementDTO::fromRequest($request))));
    }

    public function getById(IndexRequest $request,Counterparty $counterparty)
    {
        return $this->paginate(CounterpartyAgreementResource::collection($this->repository->getById($counterparty, $request->validated())));
    }
}

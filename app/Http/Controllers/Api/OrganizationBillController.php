<?php

namespace App\Http\Controllers\Api;

use App\DTO\CurrencyDTO;
use App\DTO\ExchangeRateDTO;
use App\DTO\OrganizationBillDTO;
use App\DTO\PriceTypeDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CurrencyRequest;
use App\Http\Requests\Api\ExchangeRequest;
use App\Http\Requests\Api\OrganizationBillRequest;
use App\Http\Requests\Api\PriceTypeRequest;
use App\Http\Requests\IdRequest;
use App\Http\Resources\CurrencyResource;
use App\Http\Resources\ExchangeRateResource;
use App\Http\Resources\OrganizationBillResource;
use App\Http\Resources\PriceTypeResource;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\OrganizationBill;
use App\Repositories\Contracts\MassDeleteInterface;
use App\Repositories\Contracts\MassOperationInterface;
use App\Repositories\Contracts\OrganizationBillRepositoryInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class OrganizationBillController extends Controller
{
    use ApiResponse;

    public function __construct(public OrganizationBillRepositoryInterface $repository)
    {
    }

    public function index() :JsonResponse
    {
        return $this->success(OrganizationBillResource::collection($this->repository->index()));
    }

    public function show(OrganizationBill $organizationBill) :JsonResponse
    {
        return $this->success(OrganizationBillResource::make($organizationBill));
    }

    public function store(OrganizationBillRequest $request) :JsonResponse
    {
        return $this->created($this->repository->store(OrganizationBillDTO::fromRequest($request)));
    }

    public function update(OrganizationBill $organizationBill, OrganizationBillRequest $request) :JsonResponse
    {
        return $this->success(OrganizationBillResource::make($this->repository->update($organizationBill, OrganizationBillDTO::fromRequest($request))));
    }

    public function destroy(OrganizationBill $organizationBill) :JsonResponse
    {
        return $this->deleted($organizationBill->delete());
    }

    public function massDelete(IdRequest $request, MassOperationInterface $delete)
    {
        return $delete->massDelete(new OrganizationBill(), $request->validated());
    }

    public function massRestore(IdRequest $request, MassOperationInterface $restore)
    {
        return $this->success($restore->massRestore(new OrganizationBill(), $request->validated()));
    }
}

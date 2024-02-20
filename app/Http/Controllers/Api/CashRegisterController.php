<?php

namespace App\Http\Controllers\Api;

use App\DTO\CashRegisterDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CashRegister\CashRegisterRequest;
use App\Http\Requests\Api\CashRegister\CashRegisterUpdateRequest;
use App\Http\Requests\Api\IndexRequest;
use App\Http\Resources\CashRegisterResource;
use App\Models\CashRegister;
use App\Repositories\CashRegisterRepository;
use App\Repositories\Contracts\CashRegisterRepositoryInterface;
use App\Traits\ApiResponse;

class CashRegisterController extends Controller
{
    use ApiResponse;

    public function __construct(public CashRegisterRepositoryInterface $repository)
    {
    }

    public function index(IndexRequest $request)
    {
        return $this->paginate(CashRegisterResource::collection($this->repository->index($request->validated())));
    }

    public function show(CashRegister $cashRegister)
    {
        return $this->success(CashRegisterResource::make($cashRegister->load(['currency', 'organization'])));
    }

    public function store(CashRegisterRequest $request)
    {
        return $this->created(CashRegisterResource::make($this->repository->store(CashRegisterDTO::fromRequest($request))));
    }

    public function update(CashRegister $cashRegister, CashRegisterUpdateRequest $request)
    {
        return $this->success(CashRegisterResource::make($this->repository->update($cashRegister, CashRegisterDTO::fromRequest($request))));
    }
}

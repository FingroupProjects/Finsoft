<?php

namespace App\Http\Controllers\Api;

use App\DTO\CashRegisterDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CashRegister\CashRegisterRequest;
use App\Http\Requests\Api\CashRegister\CashRegisterUpdateRequest;
use App\Http\Resources\CashRegisterResource;
use App\Models\CashRegister;
use App\Repositories\CashRegisterRepository;
use App\Traits\ApiResponse;


class CashRegisterController extends Controller
{
    use ApiResponse;

    public function index(CashRegisterRepository $repository)
    {
        return $this->success(CashRegisterResource::collection($repository->index()));
    }

    public function show(CashRegister $cashRegister)
    {
       return $this->success(CashRegisterResource::make($cashRegister));
    }

    public function store(CashRegisterRepository $repository ,CashRegisterRequest $request)
    {
        return $this->created(CashRegisterResource::make($repository->store(CashRegisterDTO::fromRequest($request))));
    }

    public function update(CashRegister $cashRegister, CashRegisterUpdateRequest $request, CashRegisterRepository $repository)
    {
        return $this->success(CashRegisterResource::make($repository->update($cashRegister, CashRegisterDTO::fromRequest($request))));
    }
}

<?php

namespace App\Repositories;

use App\DTO\CashRegisterDTO;
use App\Models\CashRegister;
use App\Repositories\Contracts\CashRegisterRepositoryInterface;
use Illuminate\Support\Collection;

class CashRegisterRepository implements CashRegisterRepositoryInterface
{

    public function index(): Collection
    {
        return CashRegister::with(['currency', 'organization'])->get();
    }

    public function store(CashRegisterDTO $DTO)
    {
        CashRegister::create([
           'name' => $DTO->name,
           'currency_id' => $DTO->currency_id,
           'organization_id' => $DTO->organization_id
       ]);

    }

    public function update(CashRegister $cashRegister, CashRegisterDTO $DTO): CashRegister
    {
        $cashRegister->update([
            'name' => $DTO->name,
            'currency_id' => $DTO->currency_id,
            'organization_id' => $DTO->organization_id
        ]);

        return $cashRegister->load(['currency', 'organization']);
    }
}

<?php

namespace App\Repositories;

use App\DTO\CounterpartyDTO;
use App\DTO\LoginDTO;
use App\Models\Counterparty;
use App\Models\User;
use App\Repositories\Contracts\AuthRepositoryInterface;
use App\Repositories\Contracts\CounterpartyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CounterpartyRepository implements CounterpartyRepositoryInterface
{

    public function index(): Collection
    {
        return Counterparty::get();
    }

    public function store(CounterpartyDTO $DTO)
    {

       $model = Counterparty::create([
           'name' => $DTO->name,
           'address' => $DTO->address,
           'phone' => $DTO->phone,
           'email' => $DTO->email
       ]);

       $model->roles()->attach($DTO->roles);

    }

    public function update(Counterparty $counterparty, CounterpartyDTO $DTO): Counterparty
    {
        $counterparty->update([
            'name' => $DTO->name,
            'address' => $DTO->address,
            'phone' => $DTO->phone,
            'email' => $DTO->email
        ]);
        $counterparty->roles()->detach();
        $counterparty->roles()->attach($DTO->roles);

        return $counterparty;

    }
}

<?php

namespace App\Repositories;

use App\DTO\CounterpartyDTO;
use App\DTO\LoginDTO;
use App\Models\Counterparty;
use App\Models\User;
use App\Repositories\Contracts\AuthRepositoryInterface;
use App\Repositories\Contracts\CounterpartyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CounterpartyRepository implements CounterpartyRepositoryInterface
{

    private $model = Counterparty::class;
    private const ON_PAGE =10;

    public function index(): Collection
    {
        return $this->model::orderBy('created_at', 'desc')->get();
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

    public function search(string $search): LengthAwarePaginator
    {
        return $this->model::where('name', 'like', "%$search%")->orWhere('phone', 'like', "$$search%")->orderBy('created_at', 'desc')->paginate(self::ON_PAGE);
    }
}

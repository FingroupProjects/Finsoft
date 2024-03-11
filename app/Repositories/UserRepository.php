<?php

namespace App\Repositories;

use App\DTO\UserDTO;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Traits\FilterTrait;
use App\Traits\Sort;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    use Sort, FilterTrait;

    public $model = User::class;

    public function index(array $data):LengthAwarePaginator
    {
        $filteredParams = $this->processSearchData($data);

        $query = $this->search($filteredParams['search']);
        $query = $this->sort($filteredParams, $query, ['organization']);

        return $query->paginate($filteredParams['itemsPerPage']);
    }

    public function store(UserDTO $DTO)
    {
        $this->model::create([
            'name' => $DTO->name,
            'surname' => $DTO->surname,
            'lastname' => $DTO->lastname,
            'organization_id' => $DTO->organization_id,
            'login' => $DTO->login,
            'password' => $DTO->password,
            'phone' => $DTO->phone,
            'email' => $DTO->email,
        ])->assignRole('user');
    }

    public function update(User $user, UserDTO $DTO)
    {
        $user->update([
            'name' => $DTO->name,
            'surname' => $DTO->surname,
            'lastname' => $DTO->lastname,
            'organization_id' => $DTO->organization_id,
            'login' => $DTO->login,
            'password' => $DTO->password,
            'phone' => $DTO->phone,
            'email' => $DTO->email,
        ]);

        return $user->load('organization');
    }

    public function search(string $search)
    {
        return $this->model::whereAny(['name', 'surname', 'lastname'], 'like', '%' . $search . '%')
            ->query(function ($query) {
                return $query->whereHas('roles', function ($query) {
                    $query->where('name', 'user');
                });
            });
    }
}

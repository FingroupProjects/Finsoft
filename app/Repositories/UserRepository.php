<?php

namespace App\Repositories;

use App\DTO\UserDTO;
use App\DTO\UserUpdateDTO;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Traits\FilterTrait;
use App\Traits\Sort;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class UserRepository implements UserRepositoryInterface
{
    use Sort, FilterTrait;

    public $model = User::class;

    public function index(array $data): LengthAwarePaginator
    {
        $filteredParams = $this->processSearchData($data);

        $query = $this->search($filteredParams['search']);

        $query = $this->sort($filteredParams, $query, ['organization', 'group']);

        return $query->paginate($filteredParams['itemsPerPage']);
    }

    public function store(UserDTO $DTO)
    {
        $image = $DTO->image ? Storage::disk('public')->put('userPhoto', $DTO->image) : null;

        $this->model::create([
            'name' => $DTO->name,
            'organization_id' => $DTO->organization_id,
            'login' => $DTO->login,
            'password' => $DTO->password,
            'phone' => $DTO->phone,
            'email' => $DTO->email,
            'image' => $image,
            'group_id' => $DTO->group_id
        ])->assignRole('user');
    }

    public function update(User $user, UserUpdateDTO $DTO)
    {
        if ($DTO->image != null) {
            $image = Storage::disk('public')->put('userPhoto', $DTO->image);
        }

        $user->update([
            'name' => $DTO->name,
            'organization_id' => $DTO->organization_id,
            'login' => $DTO->login,
            'phone' => $DTO->phone,
            'email' => $DTO->email,
            'image' => $image ?? $user->image,
            'status' => $DTO->status
        ]);

        return $user->load('organization');
    }

    public function search(string $search)
    {
        return $this->model::where('name', 'like', '%' . $search . '%');
//            ->whereHas('roles', function ($query) {
//                $query->where('name', '!=', 'admin');
//            });
    }
}

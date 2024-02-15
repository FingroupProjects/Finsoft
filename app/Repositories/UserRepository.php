<?php

namespace App\Repositories;

use App\DTO\UserDTO;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function index() :Collection
    {
        return User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->with('organization')->get();
    }

    public function store(UserDTO $DTO)
    {
        User::create([
            'name' => $DTO->name,
            'surname' => $DTO->surname,
            'lastname' => $DTO->lastname,
            'organization_id' => $DTO->organization_id,
            'login' => $DTO->login,
            'password' => $DTO->password,
            'phone' => $DTO->phone,
            'email' => $DTO->email
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
            'email' => $DTO->email
        ]);

        return $user->load('organization');
    }
}

<?php

namespace App\Repositories;

use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function index()
    {
        return User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->get();
    }

    public function store(UserDTO $DTO)
    {
        return User::create([
            'name' => $DTO->name,
            'surname' => $DTO->surname,
            'lastname' => $DTO->lastname,
            'organization_id' => $DTO->organization_id,
            'login' => $DTO->login,
            'password' => Hash::make($DTO->password),
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
            'password' => Hash::make($DTO->password),
            'phone' => $DTO->phone,
            'email' => $DTO->email
        ]);

        return $user;
    }
}

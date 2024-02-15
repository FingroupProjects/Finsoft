<?php

namespace App\Repositories\Contracts;

use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function index() :Collection;

    public function store(UserDTO $DTO);

    public function update(User $user, UserDTO $DTO);
}

<?php

namespace App\Http\Controllers\Api;

use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponse;

    public function index(UserRepository $repository)
    {
        return $this->success(UserResource::collection($repository->index()));
    }

    public function store(UserRepository $repository, UserRequest $request)
    {
        return $this->created(UserResource::make($repository->store(UserDTO::fromRequest($request))));
    }

    public function update(User $user, UserRequest $request, UserRepository $repository)
    {
        return $this->success(UserResource::make($repository->update($user, UserDTO::fromRequest($request))));
    }
}

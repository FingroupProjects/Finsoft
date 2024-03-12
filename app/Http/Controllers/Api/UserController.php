<?php

namespace App\Http\Controllers\Api;

use App\DTO\UserDTO;
use App\DTO\UserUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\IndexRequest;
use App\Http\Requests\Api\User\ChangePasswordRequest;
use App\Http\Requests\Api\User\UserRequest;
use App\Http\Requests\Api\User\UserUpdateRequest;
use App\Http\Requests\IdRequest;
use App\Http\Resources\UserResource;
use App\Models\Currency;
use App\Models\User;
use App\Repositories\Contracts\MassDeleteInterface;
use App\Repositories\Contracts\MassOperationInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ApiResponse;


    public function __construct(public UserRepositoryInterface $repository)
    {
    }

    public function index(IndexRequest $request)
    {
        return $this->paginate(UserResource::collection($this->repository->index($request->validated())));
    }

    public function show(User $user): JsonResponse
    {
        return $this->success(UserResource::make($user));
    }

    public function store(UserRepositoryInterface $repository, UserRequest $request)
    {
        return $this->created($repository->store(UserDTO::fromRequest($request)));
    }

    public function update(User $user, UserUpdateRequest $request, UserRepositoryInterface $repository)
    {
        return $this->success(UserResource::make($repository->update($user, UserUpdateDTO::fromRequest($request))));
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->validated();

        $user = User::where('id', Auth::id())->first();

        if (!Hash::check($data['oldPassword'], $user->password)) {
            return $this->error('Старый пароль неверен!');
        }

        $user->update([
            'password' => Hash::make($data['password'])
        ]);

        return $this->success('Пароль успешно изменен!');
    }

    public function massDelete(IdRequest $request, MassOperationInterface $delete)
    {
        return $delete->massDelete(new User(), $request->validated());
    }

    public function massRestore(IdRequest $request, MassOperationInterface $restore)
    {
        return $this->success($restore->massRestore(new User(), $request->validated()));
    }
}

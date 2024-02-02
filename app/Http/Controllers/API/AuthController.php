<?php

namespace App\Http\Controllers\Api;

use App\DTO\LoginDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(public AuthRepository $repository){ }

    public function login(LoginRequest $request)
    {
        $user = $this->repository->checkLogin(LoginDTO::fromRequest($request));

        if (!$user) {
            return response()->json([
               'error' => 'Логин или пароль не правильный!'
            ]);
        }

        return response()->json([
            'token' => $user->createToken("API TOKEN")->plainTextToken,
            'user' => UserResource::make($user)
        ]);
    }

}

<?php

namespace App\DTO;

use App\Enums\UserTypes;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Login;

class LoginDTO {

    public function __construct(public string $login, public string $password){ }


    public static function fromRequest(LoginRequest $request) :LoginDTO {
        return new static(
            $request->get('login'),
            $request->get('password')
        );
    }
}

<?php

namespace App\DTO;

use App\Http\Requests\Api\User\UserRequest;

class UserDTO
{
    public function __construct(public string $name, public string $surname, public string $lastname, public int $organization_id,
                public string $login, public string $password, public string $phone, public string $email)
    {
    }

    public static function fromRequest(UserRequest $request): self
    {
        return new static(
            $request->get('name'),
            $request->get('surname'),
            $request->get('lastname'),
            $request->get('organization_id'),
            $request->get('login'),
            $request->get('password'),
            $request->get('phone'),
            $request->get('email'),
        );
    }
}

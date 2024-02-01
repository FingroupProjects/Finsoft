<?php

use Illuminate\Http\JsonResponse;

interface AuthRepositoryInterface {

    public function login() :JsonResponse;
}

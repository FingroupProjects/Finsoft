<?php

use Illuminate\Http\JsonResponse;

interface AuthRepositoryInterface {

    public function register() :JsonResponse;



}

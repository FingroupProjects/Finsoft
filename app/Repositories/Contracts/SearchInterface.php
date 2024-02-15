<?php

namespace App\Repositories\Contracts;

use App\DTO\LoginDTO;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface SearchInterface {

    public function search(string $search) : LengthAwarePaginator;

}

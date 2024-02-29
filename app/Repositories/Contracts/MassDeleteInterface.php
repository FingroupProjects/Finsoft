<?php

namespace App\Repositories\Contracts;

use App\DTO\LoginDTO;
use App\Models\User;
use Illuminate\Http\JsonResponse;

interface MassDeleteInterface
{
    public function massDelete(SoftDeleteInterface $model, array $ids);
}

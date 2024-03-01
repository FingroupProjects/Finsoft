<?php

namespace App\Repositories;

use App\DTO\LoginDTO;
use App\Models\User;
use App\Repositories\Contracts\AuthRepositoryInterface;
use App\Repositories\Contracts\MassDeleteInterface;
use App\Repositories\Contracts\SoftDeleteInterface;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MassDelete implements MassDeleteInterface
{
    public function massDelete(SoftDeleteInterface $model, array $ids)
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $model->whereIn('id', $ids['ids'])->update([
            'deleted_at' => Carbon::now()
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function massRestore(SoftDeleteInterface $model, array $ids)
    {
        $model->whereIn('id', $ids['ids'])->update(['deleted_at' => null]);
    }
}

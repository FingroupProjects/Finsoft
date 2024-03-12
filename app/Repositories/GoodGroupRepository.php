<?php

namespace App\Repositories;

use App\DTO\GoodDTO;
use App\DTO\GoodGroupDTO;
use App\DTO\GoodUpdateDTO;
use App\Models\Good;
use App\Models\GoodGroup;
use App\Models\GoodImages;
use App\Repositories\Contracts\GoodGroupRepositoryInterface;
use App\Repositories\Contracts\GoodRepositoryInterface;
use App\Traits\FilterTrait;
use App\Traits\Sort;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GoodGroupRepository implements GoodGroupRepositoryInterface
{
    public function store(GoodGroupDTO $DTO)
    {
        $good = GoodGroup::create([
            'name' => $DTO->name,
            'is_good' => $DTO->is_good,
            'is_service' => $DTO->is_service,
        ]);

        return $good;
    }

}

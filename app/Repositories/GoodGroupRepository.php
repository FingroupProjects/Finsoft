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
    use Sort, FilterTrait;

    public $model = GoodGroup::class;

    public function index(array $data): LengthAwarePaginator
    {
        $filterParams = $this->processSearchData($data);

        $query = $this->search($filterParams['search']);

        $query = $this->sort($filterParams, $query, ['goods']);

        return $query->paginate($filterParams['itemsPerPage']);
    }

    public function store(GoodGroupDTO $DTO)
    {
        $good = GoodGroup::create([
            'name' => $DTO->name,
            'is_good' => $DTO->is_good,
            'is_service' => $DTO->is_service,
        ]);

        return $good;
    }

    public function getGoods(GoodGroup $goodGroup, array $data)
    {
        $filterParams = $this->processSearchData($data);

        $query = $this->searchGood($filterParams['search'], $goodGroup);

        $query = $this->sort($filterParams, $query, []);

        return $query->paginate($filterParams['itemsPerPage']);
    }

    public function search(string $search)
    {
        return $this->model::where('name', 'like', '%' . $search . '%');
    }

    public function searchGood(string $search, GoodGroup $goodGroup)
    {
        return Good::where([
            ['good_group_id', $goodGroup->id],
            ['name', 'like', '%' . $search . '%']
        ]);
    }
}

<?php

namespace App\Repositories;

use App\DTO\GoodDTO;
use App\DTO\GoodUpdateDTO;
use App\Models\Good;
use App\Models\GoodImages;
use App\Repositories\Contracts\GoodRepositoryInterface;
use App\Traits\FilterTrait;
use App\Traits\Sort;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GoodRepository implements GoodRepositoryInterface
{
    use Sort, FilterTrait;

    public $model = Good::class;

    public function index(array $data): LengthAwarePaginator
    {
        $filterParams = $this->processSearchData($data);

        $query = $this->search($filterParams['search']);

        $query = $this->sort($filterParams, $query, ['category']);

        return $query->paginate($filterParams['itemsPerPage']);
    }

    public function store(GoodDTO $DTO)
    {
        return DB::transaction(function () use ($DTO) {
            $good = Good::create([
                'name' => $DTO->name,
                'vendor_code' => $DTO->vendor_code,
                'description' => $DTO->description,
                'category_id' => $DTO->category_id,
                'unit_id' => $DTO->unit_id,
                'barcode' => $DTO->barcode,
                'storage_id' => $DTO->storage_id,
            ]);

            GoodImages::insert($this->goodImages($good, $DTO->images));
        });
    }

    public function update(Good $good, GoodUpdateDTO $DTO): Good
    {
        $good->update([
            'name' => $DTO->name,
            'vendor_code' => $DTO->vendor_code,
            'description' => $DTO->description,
            'category_id' => $DTO->category_id,
            'unit_id' => $DTO->unit_id,
            'barcode' => $DTO->barcode,
            'storage_id' => $DTO->storage_id,
        ]);

        return $good;
    }

    public function goodImages($good, $images)
    {
        foreach ($images as $image) {
            $img = Storage::disk('public')->put('goodImages', $image->img);

            $imgs[] = [
                'good_id' => $good->id,
                'image' => $img,
                'is_main' => $image->is_main,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        return $imgs;
    }

    public function search(string $search)
    {
        return $this->model::where('name', 'like', '%' . $search . '%');
    }
}

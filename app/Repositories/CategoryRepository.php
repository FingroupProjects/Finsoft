<?php

namespace App\Repositories;

use App\DTO\CategoryDTO;
use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Traits\FilterTrait;
use App\Traits\ValidFields;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    use ValidFields, FilterTrait;

    public $model = Category::class;

    public function index(array $data): LengthAwarePaginator
    {
        $filterParams = $this->processSearchData($data);

        $query = $this->model::search($filterParams['search']);
        
        $query1 = $this->sort($filteredParams, $query);

        $query1->query(function ($query) {
            return $query->with(['organization', 'currency']);
        });

        return $query->paginate($filterParams['itemsPerPage']);
    }


    public function store(CategoryDTO $DTO)
    {
        return Category::create([
            'name' => $DTO->name,
        ]);
    }

    public function update(Category $category, CategoryDTO $DTO) :Category
    {
        $category->update([
            'name' => $DTO->name,
        ]);

        return $category;
    }
}

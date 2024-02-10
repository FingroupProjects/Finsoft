<?php

namespace App\Repositories;

use App\DTO\CategoryDTO;
use App\Models\Category;
use Illuminate\Support\Collection;

class CategoryRepository
{
    public function index() :Collection
    {
        return Category::get();
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

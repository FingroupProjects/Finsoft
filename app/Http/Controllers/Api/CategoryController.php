<?php

namespace App\Http\Controllers\Api;

use App\DTO\CategoryDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Category\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Traits\ApiResponse;

class CategoryController extends Controller
{
    use ApiResponse;

    public function index(CategoryRepository $repository)
    {
        return $this->success(CategoryResource::collection($repository->index()));
    }

    public function store(CategoryRequest $request, CategoryRepository $repository)
    {
        return $this->created(CategoryResource::make($repository->store(CategoryDTO::fromRequest($request))));
    }

    public function update(Category $category, CategoryRequest $request, CategoryRepository $repository)
    {
        return $this->success(CategoryResource::make($repository->update($category, CategoryDTO::fromRequest($request))));
    }
}

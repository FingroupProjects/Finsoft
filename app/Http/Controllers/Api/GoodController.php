<?php

namespace App\Http\Controllers\Api;

use App\DTO\GoodDTO;
use App\DTO\GoodUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Good\GoodRequest;
use App\Http\Requests\Api\Good\GoodUpdateRequest;
use App\Http\Resources\GoodResource;
use App\Models\Good;
use App\Repositories\GoodRepository;
use App\Traits\ApiResponse;

class GoodController extends Controller
{
    use ApiResponse;

    public function index(GoodRepository $repository)
    {
        return $this->success(GoodResource::collection($repository->index()));
    }

    public function store(GoodRequest $request, GoodRepository $repository)
    {
        return $this->created(GoodResource::make($repository->store(GoodDTO::fromRequest($request))));
    }

    public function update(Good $good, GoodUpdateRequest $request, GoodRepository $repository)
    {
        return $this->success(GoodResource::make($repository->update($good, GoodUpdateDTO::fromRequest($request))));
    }
}

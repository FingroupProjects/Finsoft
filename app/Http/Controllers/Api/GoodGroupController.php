<?php

namespace App\Http\Controllers\Api;

use App\DTO\GoodGroupDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Good\GoodGroupRequest;
use App\Http\Resources\GoodGroupResource;
use App\Models\GoodGroup;
use App\Repositories\Contracts\GoodGroupRepositoryInterface;
use App\Traits\ApiResponse;

class GoodGroupController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success(GoodGroupResource::collection(GoodGroup::orderBy('created_at', 'desc')->get()));
    }

    public function store(GoodGroupRequest $request, GoodGroupRepositoryInterface $repository)
    {
        return $this->created(GoodGroupResource::make($repository->store(GoodGroupDTO::fromRequest($request))));
    }

}

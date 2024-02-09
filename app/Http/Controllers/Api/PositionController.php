<?php

namespace App\Http\Controllers\Api;

use App\DTO\PositionDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Position\PositionRequest;
use App\Http\Resources\PositionResource;
use App\Models\Position;
use App\Repositories\PositionRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class PositionController extends Controller
{
    use ApiResponse;

    public function index(): JsonResponse
    {
        return $this->success(PositionResource::collection(Position::get()));
    }

    public function store(PositionRepository $repository, PositionRequest $request): JsonResponse
    {
        return $this->created(PositionResource::make($repository->store(PositionDTO::formRequest($request))));
    }

    public function update(Position $position, PositionRequest $request, PositionRepository $repository)
    {
        return $this->success(PositionResource::make($repository->update($position, PositionDTO::formRequest($request))));
    }

    public function delete(Position $position)
    {
        return $this->deleted($position->delete());
    }
}

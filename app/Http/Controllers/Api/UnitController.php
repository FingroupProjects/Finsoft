<?php

namespace App\Http\Controllers\Api;

use App\DTO\UnitDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Unit\UnitRequest;
use App\Http\Resources\UnitResource;
use App\Models\Unit;
use App\Repositories\UnitRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    use ApiResponse;

    public function index(UnitRepository $repository)
    {
        return $this->success(UnitResource::collection($repository->index()));
    }

    public function store(UnitRequest $request, UnitRepository $repository)
    {
        return $this->created(UnitResource::make($repository->store(UnitDTO::fromRequest($request))));
    }

    public function update(Unit $unit, UnitRequest $request, UnitRepository $repository)
    {
        return $this->success(UnitResource::make($repository->update($unit, UnitDTO::fromRequest($request))));
    }

    public function destroy(Unit $unit)
    {
        return $this->deleted($unit->delete());
    }
}
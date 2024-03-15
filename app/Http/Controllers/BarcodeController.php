<?php

namespace App\Http\Controllers;

use App\DTO\BarcodeDTO;
use App\DTO\GroupDTO;
use App\Http\Requests\Api\Group\GroupRequest;
use App\Http\Requests\Api\IndexRequest;
use App\Http\Requests\BarcodeRequest;
use App\Http\Resources\BarcodeResource;
use App\Http\Resources\GroupResource;
use App\Models\Barcode;
use App\Models\Good;
use App\Models\Group;
use App\Repositories\Contracts\BarcodeRepository;
use App\Repositories\Contracts\GroupRepositoryInterface;
use App\Traits\ApiResponse;

class BarcodeController extends Controller
{
    use ApiResponse;

    public function __construct(public BarcodeRepository $repository)
    {

    }

    public function index(Good $good, IndexRequest $request)
    {
        return $this->success(BarcodeResource::collection($this->repository->index($request->validated(), $good)));
    }

    public function store(BarcodeRequest $request)
    {
        return $this->created(BarcodeResource::make($this->repository->store(BarcodeDTO::fromRequest($request))));
    }

    public function update(Barcode $barcode, BarcodeRequest $request)
    {
        return $this->success(GroupResource::make($this->repository->update($barcode, BarcodeDTO::fromRequest($request))));
    }

    public function destroy(Barcode $barcode)
    {
        return $this->deleted($barcode->delete());
    }
}

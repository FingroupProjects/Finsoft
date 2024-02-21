<?php

namespace App\Http\Controllers\Api;

use App\DTO\StorageDTO;
use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\IndexRequest;
use App\Http\Requests\Api\Storage\StorageRequest;
use App\Http\Requests\Api\User\UserRequest;
use App\Http\Resources\StorageResource;
use App\Http\Resources\UserResource;
use App\Models\Storage;
use App\Models\User;
use App\Repositories\Contracts\StorageRepositoryInterface;
use App\Repositories\StorageRepository;
use App\Repositories\UserRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    use ApiResponse;

    public function __construct(public StorageRepositoryInterface $repository)
    {
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->paginate(StorageResource::collection($this->repository->index($indexRequest->validated())));
    }

    public function show(Storage $storage) :JsonResponse
    {
        return $this->success(StorageResource::make($storage));
    }

    public function store(StorageRepository $repository, StorageRequest $request)
    {
        return $this->created(StorageResource::make($repository->store(StorageDTO::fromRequest($request))));
    }

    public function update(Storage $storage, StorageRequest $request, StorageRepository $repository)
    {
        return $this->success(UserResource::make($repository->update($storage, StorageDTO::fromRequest($request))));
    }

    public function destroy(Storage $storage)
    {
        return $this->deleted($storage->delete());
    }
}

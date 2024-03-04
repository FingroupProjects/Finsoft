<?php

namespace App\Http\Controllers\Api;

use App\DTO\StorageDTO;
use App\DTO\StorageEmployeeDTO;
use App\DTO\StorageEmployeeUpdateDTO;
use App\DTO\StorageUpdateDTO;
use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\IndexRequest;
use App\Http\Requests\Api\Storage\StorageEmployeeRequest;
use App\Http\Requests\Api\Storage\StorageEmployeeUpdateRequest;
use App\Http\Requests\Api\Storage\StorageRequest;
use App\Http\Requests\Api\User\UserRequest;
use App\Http\Requests\IdRequest;
use App\Http\Resources\EmployeeStorageResource;
use App\Http\Resources\StorageResource;
use App\Http\Resources\UserResource;
use App\Models\Currency;
use App\Models\EmployeeStorage;
use App\Models\Storage;
use App\Models\User;
use App\Repositories\Contracts\MassDeleteInterface;
use App\Repositories\Contracts\MassOperationInterface;
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

    public function store(StorageRequest $request)
    {
        return $this->created($this->repository->store(StorageDTO::fromRequest($request)));
    }

    public function update(Storage $storage, StorageRequest $request)
    {
        return $this->success(StorageResource::make($this->repository->update($storage, StorageUpdateDTO::fromRequest($request))));
    }

    public function updateEmployee(EmployeeStorage $employee, StorageEmployeeUpdateRequest $request)
    {
        return $this->success($this->repository->updateEmployee($employee, StorageEmployeeUpdateDTO::fromRequest($request)));
    }

    public function addEmployee(Storage $storage, StorageEmployeeRequest $request)
    {
        return $this->created($this->repository->addEmployee($storage, StorageEmployeeDTO::fromRequest($request)));
    }

    public function getEmployeesByStorageId(Storage $storage, IndexRequest $indexRequest)
    {
        return $this->paginate(EmployeeStorageResource::collection($this->repository->getEmployeesByStorageId($storage, $indexRequest->validated())));
    }

    public function destroy(Storage $storage)
    {
        return $this->deleted($storage->delete());
    }

    public function massDelete(IdRequest $request, MassOperationInterface $delete)
    {
        return $delete->massDelete(new Storage(), $request->validated());
    }

    public function massRestore(IdRequest $request, MassOperationInterface $restore)
    {
        return $this->success($restore->massRestore(new Storage(), $request->validated()));
    }
}

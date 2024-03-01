<?php

namespace App\Http\Controllers\Api;

use App\DTO\EmployeeDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\EmployeeRequest;
use App\Http\Requests\Api\Employee\EmployeeUpdateRequest;
use App\Http\Requests\Api\IndexRequest;
use App\Http\Requests\IdRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use App\Repositories\Contracts\MassDeleteInterface;
use App\Repositories\Contracts\MassOperationInterface;
use App\Repositories\EmployeeRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use ApiResponse;

    public function __construct(public EmployeeRepositoryInterface $repository)
    {
    }

    public function index(IndexRequest $request)
    {
        return $this->paginate(EmployeeResource::collection($this->repository->index($request->validated())));
    }

    public function show(Employee $employee) :JsonResponse
    {
        return $this->success(EmployeeResource::make($employee));
    }

    public function store(EmployeeRepositoryInterface $repository, EmployeeRequest $request)
    {
        return $this->created(EmployeeResource::make($repository->store(EmployeeDTO::fromRequest($request))));
    }

    public function update(Employee $employee, EmployeeRequest $request, EmployeeRepositoryInterface $repository)
    {
        return $this->success(EmployeeResource::make($repository->update($employee, EmployeeDTO::fromRequest($request))));
    }

    public function destroy(Employee $employee)
    {
        return $this->deleted($employee->delete());
    }

    public function massDelete(IdRequest $request, MassOperationInterface $delete)
    {
        return $delete->massDelete(new Employee(), $request->validated());
    }
}

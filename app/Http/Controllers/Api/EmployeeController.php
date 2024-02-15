<?php

namespace App\Http\Controllers\Api;

use App\DTO\EmployeeDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\EmployeeRequest;
use App\Http\Requests\Api\Employee\EmployeeUpdateRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use App\Repositories\EmployeeRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use ApiResponse;

    public function index(EmployeeRepositoryInterface $repository)
    {
        return $this->success(EmployeeResource::collection($repository->index()));
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
        return $this->success(EmployeeResource::make($repository->update($employee ,EmployeeDTO::fromRequest($request))));
    }

    public function destroy(Employee $employee)
    {
        return $this->deleted($employee->delete());
    }
}

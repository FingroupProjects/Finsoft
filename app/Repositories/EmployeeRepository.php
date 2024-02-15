<?php

namespace App\Repositories;

use App\DTO\CashRegisterDTO;
use App\DTO\EmployeeDTO;
use App\Models\CashRegister;
use App\Models\Employee;
use App\Repositories\Contracts\CashRegisterRepositoryInterface;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class EmployeeRepository implements EmployeeRepositoryInterface
{

    public function index(): Collection
    {
        return Employee::get();
    }

    public function store(EmployeeDTO $DTO)
    {

        $image = $DTO->image ? Storage::disk('public')->put('employeePhoto', $DTO->image) : null;

        return Employee::create([
           'name' => $DTO->name,
           'surname' => $DTO->surname,
           'lastname' => $DTO->lastname,
           'image' => $image
       ]);

    }

    public function update(Employee $employee, EmployeeDTO $DTO): Employee
    {
        if ($DTO->image != null) $image = Storage::disk('public')->put('employeePhoto', $DTO->image);

        $employee->update([
            'name' => $DTO->name,
            'surname' => $DTO->surname,
            'lastname' => $DTO->lastname,
            'image' => $image ?? $employee->image,
        ]);

        return $employee;
    }
}

<?php

namespace App\Repositories\Contracts;

use App\DTO\LoginDTO;
use App\DTO\OrganizationBillDTO;
use App\Models\OrganizationBill;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface OrganizationBillRepositoryInterface
{
    public function index(array $data) :LengthAwarePaginator;

    public function store(OrganizationBillDTO $dto);

    public function update(OrganizationBill $bill, OrganizationBillDTO $dto) :OrganizationBill;
}

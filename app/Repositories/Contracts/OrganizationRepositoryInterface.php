<?php

namespace App\Repositories\Contracts;

use App\DTO\OrganizationDTO;
use App\Models\Organization;
use Illuminate\Support\Collection;

interface OrganizationRepositoryInterface
{
    public function index() :Collection;

    public function store(OrganizationDTO $DTO);

    public function update(Organization $organization, OrganizationDTO $DTO) :Organization;
}

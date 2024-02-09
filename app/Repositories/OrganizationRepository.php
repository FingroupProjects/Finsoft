<?php

namespace App\Repositories;

use App\DTO\OrganizationDTO;
use App\Models\Organization;
use Illuminate\Support\Collection;

class OrganizationRepository
{
    public function index() :Collection
    {
        return Organization::get();
    }

    public function store(OrganizationDTO $DTO)
    {
        return Organization::create([
            'name' => $DTO->name,
        ]);
    }

    public function update(Organization $organization, OrganizationDTO $DTO) :Organization
    {
        $organization->update([
            'name' => $DTO->name,
        ]);

        return $organization;
    }
}
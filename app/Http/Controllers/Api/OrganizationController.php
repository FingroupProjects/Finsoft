<?php

namespace App\Http\Controllers\Api;

use App\DTO\OrganizationDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Organization\OrganizationRequest;
use App\Http\Requests\Api\Organization\OrganizationUpdateRequest;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;
use App\Repositories\OrganizationRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    use ApiResponse;

    public function index(OrganizationRepository $repository)
    {
        return $this->success(OrganizationResource::collection($repository->index()));
    }

    public function store(OrganizationRequest $request, OrganizationRepository $repository)
    {
        return $this->created(OrganizationResource::make($repository->store(OrganizationDTO::fromRequest($request))));
    }

    public function update(Organization $organization, OrganizationUpdateRequest $request, OrganizationRepository $repository)
    {
        return $this->success(OrganizationResource::make($repository->update($organization, OrganizationDTO::fromRequest($request))));
    }

    public function destroy(Organization $organization)
    {
        return $this->deleted($organization->delete());
    }
}

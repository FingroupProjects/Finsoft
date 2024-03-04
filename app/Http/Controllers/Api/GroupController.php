<?php

namespace App\Http\Controllers\Api;

use App\DTO\GroupDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Group\GroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Repositories\Contracts\GroupRepositoryInterface;
use App\Traits\ApiResponse;

class GroupController extends Controller
{
    use ApiResponse;

    public function __construct(public GroupRepositoryInterface $repository)
    {
    }

    public function store(GroupRequest $request)
    {
        return $this->created(GroupResource::make($this->repository->store(GroupDTO::fromRequest($request))));
    }

    public function update(Group $group, GroupRequest $request)
    {
        return $this->success(GroupResource::make($this->repository->update($group, GroupDTO::fromRequest($request))));
    }

    public function destroy(Group $group)
    {
        return $this->deleted($group->delete());
    }
}

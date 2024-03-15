<?php

namespace App\Repositories;

use App\DTO\GroupDTO;
use App\Models\Group;
use App\Repositories\Contracts\GroupRepositoryInterface;

class GroupRepository implements GroupRepositoryInterface
{
    public function store(GroupDTO $DTO)
    {
        return Group::create([
            'name' => $DTO->name,
            'type' => $DTO->type
        ]);
    }

    public function update(Group $group, GroupDTO $DTO) :Group
    {
        $group->update([
            'name' => $DTO->name,
        ]);

        return $group;
    }
}

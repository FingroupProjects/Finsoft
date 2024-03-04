<?php

namespace App\Repositories\Contracts;

use App\DTO\GroupDTO;
use App\Models\Group;

interface GroupRepositoryInterface
{
    public function store(GroupDTO $DTO);

    public function update(Group $group, GroupDTO $DTO) :Group;
}

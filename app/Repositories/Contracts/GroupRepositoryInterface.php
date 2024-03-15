<?php

namespace App\Repositories\Contracts;

use App\DTO\GroupDTO;
use App\Models\Group;
use Illuminate\Pagination\LengthAwarePaginator;

interface GroupRepositoryInterface
{
    public function index(int $id, array $data) :LengthAwarePaginator;

    public function store(GroupDTO $DTO);

    public function update(Group $group, GroupDTO $DTO) :Group;
}

<?php

namespace App\Repositories;

use App\DTO\OrganizationDTO;
use App\Models\Organization;
use App\Repositories\Contracts\OrganizationRepositoryInterface;
use App\Traits\FilterTrait;
use App\Traits\Sort;
use Illuminate\Pagination\LengthAwarePaginator;

class OrganizationRepository implements OrganizationRepositoryInterface
{
    public const ON_PAGE = 10;

    public $model = Organization::class;

    use Sort, FilterTrait;

    public function index(array $data): LengthAwarePaginator
    {
        $filteredParams = $this->processSearchData($data);

        $query = $this->search($filteredParams['search']);

        $query = $this->sort($filteredParams, $query, ['director', 'chiefAccountant']);

        return $query->paginate($filteredParams['itemsPerPage']);
    }

    public function store(OrganizationDTO $DTO)
    {
        return Organization::create([
            'name' => $DTO->name,
            'INN' => $DTO->INN,
            'director_id' => $DTO->director_id,
            'chief_accountant_id' => $DTO->chief_accountant_id,
            'address' => $DTO->address,
            'description' => $DTO->description
        ]);
    }

    public function update(Organization $organization, OrganizationDTO $DTO) :Organization
    {
        $organization->update([
            'name' => $DTO->name,
            'INN' => $DTO->INN,
            'director_id' => $DTO->director_id,
            'chief_accountant_id' => $DTO->chief_accountant_id,
            'address' => $DTO->address,
            'description' => $DTO->description
        ]);

        return $organization;
    }

    public function search(string $search)
    {
        return $this->model::where('name', 'like', '%' . $search . '%')
            ->orWhereHas('chiefAccountant', function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('director', function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            });
    }
}

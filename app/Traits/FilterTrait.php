<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait FilterTrait
{
    protected function processSearchData(array $data): array
    {
        return [
            'search' => $data['search'] ?? '',
            'orderBy' => $data['orderBy'] ?? null,
            'direction' => $data['sort'] ?? 'asc',
            'itemsPerPage' => isset($data['itemsPerPage']) ? ($data['itemsPerPage'] == 10 ? 25 : $data['itemsPerPage']) : 25,
            'currency_id' => $data['currency_id'] ?? null,
            'organization_id' => $data['organization_id'] ?? null
        ];
    }

    protected function orderFields($filteredParams, $query)
    {
        if (!is_null($filteredParams['orderBy'])) {
            if (Str::contains($filteredParams['orderBy'], '.')) {
                list($relation, $field) = explode('.', $filteredParams['orderBy']);

               return $query->query(function ($q) use ($relation, $field, $filteredParams) {
                    $q->with([$relation => function ($query) use ($field, $filteredParams) {
                        $query->orderBy($field, $filteredParams['direction']);
                    }]);
                });
            } else {

              return  $query->orderBy($filteredParams['orderBy'], $filteredParams['direction']);
            }
        }
    }
}

<?php

namespace App\Traits;

trait FilterTrait {

    protected function processSearchData(array $data): array
    {
        return [
            'search' => $data['search'] ?? '',
            'orderBy' => $data['orderBy'] ?? null,
            'direction' => $data['sort'] ?? 'asc',
            'itemsPerPage' => $data['itemsPerPage'] ?? self::ON_PAGE
        ];
    }
}


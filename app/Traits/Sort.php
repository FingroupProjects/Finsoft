<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Sort
{

    public function sort(array $filteredParams, $query, array $relations)
    {
        if (array_key_exists('orderBy', $filteredParams)) {
            if (Str::contains($filteredParams['orderBy'], '.')) {
                list($relation, $field) = explode('.', $filteredParams['orderBy']);

                $relatedTable = app($this->model)->$relation()->getRelated()->getTable();

                $thisTable = app($this->model)->getTable();

                return $query->query(function ($query) use ($relation, $relatedTable, $thisTable, $filteredParams, $field, $relations) {
                    $query->with($relations)->join($relatedTable, "$thisTable.{$relation}_id", '=', "{$relatedTable}.id")
                        ->orderBy("{$relatedTable}.{$field}", $filteredParams['direction'])
                        ->select("{$thisTable}.*");
                });
            }
            return $query->query(function ($query) use ($relations) {
                return $query->with($relations);
            })->orderBy($filteredParams['orderBy'], $filteredParams['direction']);

        }

        return $query->query(function ($query) use ($relations) {
            $query->with($relations)->orderBy('deleted_at');
        });
    }

}

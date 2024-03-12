<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Sort
{
    public function sort(array $filteredParams, $query, array $relations = [])
    {
        if (!is_null($filteredParams['orderBy'])) {
            if (Str::contains($filteredParams['orderBy'], '.')) {
                list($relation, $field) = explode('.', $filteredParams['orderBy']);

                $relatedTable = app($this->model)->$relation()->getRelated()->getTable();

                $thisTable = app($this->model)->getTable();

                return $query->with($relations)->join($relatedTable, "$thisTable.{$relation}_id", '=', "{$relatedTable}.id")
                        ->orderBy("{$relatedTable}.{$field}", $filteredParams['direction'])
                        ->select("{$thisTable}.*");
            }
            return  $query->with($relations);
        }
        return $query->with($relations)->orderBy('created_at', 'desc')->orderBy('deleted_at',);
    }


}

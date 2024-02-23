<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait ValidFields
{
    public function isValidField(string $field) :bool
    {
        if ($field === 'id') {
            return true;
        }
        $model = app($this->model);

        return in_array($field, $model->getFillable());
    }

    public function sort(array $filteredParams, $query, array $relations)
    {
        if (!is_null($filteredParams['orderBy'])) {
            if (Str::contains($filteredParams['orderBy'], '.')) {
                list($relation, $field) = explode('.', $filteredParams['orderBy']);

                $relatedModel = new $this->model;
                $relatedModel = $relatedModel->$relation()->getRelated();
                $relatedTable = $relatedModel->getTable();


                $this_model = new $this->model;
                $this_table = $this_model->getTable();

                return $query->query(function ($query) use ($relation, $relatedTable, $this_table, $filteredParams, $field, $relations) {
                    $query->with($relations)->join($relatedTable, "$this_table.{$relation}_id", '=', "{$relatedTable}.id")
                        ->orderBy("{$relatedTable}.{$field}", $filteredParams['direction'])
                        ->select("{$this_table}.*");
                });

            } else {
               return $query->query(function ($query) use ($relations){
                   return $query->with($relations);
               })->orderBy($filteredParams['orderBy'], $filteredParams['direction']);
            }
        }
        return $query->query(function ($query) use ($relations) {
            $query->with($relations);
        });
    }

}

<?php

namespace App\Traits;

trait ValidFields {

    public function isValidField(string $field) :bool
    {
        $model = app($this->model);

        return in_array($field, $model->getFillable());
    }
}

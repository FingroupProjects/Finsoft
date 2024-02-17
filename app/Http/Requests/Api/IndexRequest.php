<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function rules(): array
    {
        $model = $this->getModel();

        $fillableFields = implode(',', $model->getFillable());

        return [
            'search' => 'string|nullable|max:20',
            'itemsPerPage' => 'integer|min:10|nullable',
            'orderBy' => 'in:id,' . $fillableFields,
            'sort' => 'in:asc,desc'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    private function getModel()
    {
        $repository = $this->route()->getController();

        return app($repository->repository->model);
    }
}
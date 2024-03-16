<?php

namespace App\Http\Requests\Api\OrganizationBill;

use ErrorException;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionMethod;

class FilterRequest extends FormRequest
{
    public function rules(): array
    {
        $model = $this->getModel();

        $fillableFields = $this->getFillableWithRelationships($model);

        return [
            'search' => 'string|nullable|max:20',
            'itemsPerPage' => 'integer|nullable',
            'orderBy' => 'nullable|in:id,deleted_at,currency.name,organization.name,' . implode(',', $fillableFields),
            'sort' => 'in:asc,desc',
            'currency_id' => 'nullable|integer',
            'organization_id' => 'nullable|integer',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    private function getFillableWithRelationships($model) :array
    {

        $fillableFields = $model->getFillable();

        return $fillableFields;

    }

    private function getModel()
    {
        $repository = $this->route()->getController();

        return app($repository->repository->model);
    }
}

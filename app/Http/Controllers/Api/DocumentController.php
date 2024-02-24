<?php

namespace App\Http\Controllers\Api;

use App\DTO\DocumentDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Document\DocumentRequest;
use App\Http\Requests\Api\Document\DocumentUpdateRequest;
use App\Http\Requests\Api\IndexRequest;
use App\Http\Resources\DocumentResource;
use App\Models\Status;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class DocumentController extends Controller
{
    use ApiResponse;

    public function __construct(public DocumentRepositoryInterface $repository) { }

    public function update(DocumentUpdateRequest $request): JsonResponse
    {
        return $this->created($this->repository->store(DocumentDTO::fromRequest($request), Status::CLIENT_PURCHASE));
    }

    public function approve()
    {

    }
}

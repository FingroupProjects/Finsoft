<?php

namespace App\Http\Controllers\Api;

use App\DTO\DocumentDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Document\DocumentRequest;
use App\Http\Resources\DocumentResource;
use App\Models\Status;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class ProviderDocumentController extends Controller
{
    use ApiResponse;

    public function __construct(public DocumentRepositoryInterface $repository) { }

    public function purchaseDocuments(): JsonResponse
    {
        return $this->success(DocumentResource::collection($this->repository->index(Status::PURCHASE)));
    }

    public function purchase(DocumentRequest $request): JsonResponse
    {
        return $this->created($this->repository->store(DocumentDTO::fromRequest($request), Status::PURCHASE));
    }

    public function returnToProviderDocuments(): JsonResponse
    {
        return $this->success(DocumentResource::collection($this->repository->index(Status::RETURN_TO_PROVIDER)));
    }

    public function returnToProvider(DocumentRequest $request): JsonResponse
    {
        return $this->created($this->repository->store(DocumentDTO::fromRequest($request), Status::RETURN_TO_PROVIDER));
    }

    public function merge(string $doc_number)
    {
        return $this->success($this->repository);
    }
}

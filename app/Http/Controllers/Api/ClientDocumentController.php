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

class ClientDocumentController extends Controller
{
    use ApiResponse;

    public function __construct(public DocumentRepositoryInterface $repository) { }

    public function saleDocuments(): JsonResponse
    {
        return $this->success(DocumentResource::collection($this->repository->index(Status::SALE_TO_CLIENT)));
    }

    public function sale(DocumentRequest $request): JsonResponse
    {
        return $this->created($this->repository->store(DocumentDTO::fromRequest($request), Status::SALE_TO_CLIENT));
    }

    public function returnFromClientDocuments(): JsonResponse
    {
        return $this->success(DocumentResource::collection($this->repository->index(Status::RETURN_FROM_CLIENT)));
    }

    public function returnFromClient(DocumentRequest $request): JsonResponse
    {
        return $this->created($this->repository->store(DocumentDTO::fromRequest($request), Status::RETURN_FROM_CLIENT));
    }
}

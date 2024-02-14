<?php

namespace App\Http\Controllers\Api;

use App\DTO\DocumentDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Document\DocumentRequest;
use App\Http\Resources\DocumentResource;
use App\Repositories\DocumentRepository;
use App\Traits\ApiResponse;

class DocumentController extends Controller
{
    use ApiResponse;

    public function index(DocumentRepository $repository)
    {
        return $this->success(DocumentResource::collection($repository->index()));
    }

    public function store(DocumentRepository $repository, DocumentRequest $request)
    {
        return $this->created($repository->store(DocumentDTO::fromRequest($request)));
    }
}

<?php

namespace App\Repositories\Contracts;

use App\DTO\DocumentDTO;
use App\Models\Document;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface DocumentRepositoryInterface
{
    public function index(int $status, array $data) :LengthAwarePaginator;

    public function store(DocumentDTO $DTO, int $status);

    public function update(Document $document, DocumentDTO $DTO) :Document;

    public function approve(Document $document);
}

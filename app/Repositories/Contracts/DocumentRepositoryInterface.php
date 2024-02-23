<?php

namespace App\Repositories\Contracts;

use App\DTO\DocumentDTO;
use App\Models\Document;
use Illuminate\Support\Collection;

interface DocumentRepositoryInterface
{
    public function index(int $status) :Collection;

    public function store(DocumentDTO $DTO, int $status);

    public function update(Document $document, DocumentDTO $DTO) :Document;

    public function merge(string $doc_number);
}

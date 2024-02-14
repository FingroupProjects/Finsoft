<?php

namespace App\Repositories\Contracts;

use App\DTO\DocumentDTO;
use App\Models\Document;
use Illuminate\Support\Collection;

interface DocumentRepositoryInterface
{
    public function index() :Collection;

    public function store(DocumentDTO $DTO);

    public function update(Document $document, DocumentDTO $DTO) :Document;
}

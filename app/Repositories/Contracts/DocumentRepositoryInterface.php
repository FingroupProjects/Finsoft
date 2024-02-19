<?php

namespace App\Repositories\Contracts;

use App\DTO\DocumentDTO;
use App\Models\PreliminaryDocument;
use Illuminate\Support\Collection;

interface DocumentRepositoryInterface
{
    public function index(int $status) :Collection;

    public function store(DocumentDTO $DTO, int $status);

    public function update(PreliminaryDocument $document, DocumentDTO $DTO) :PreliminaryDocument;
}

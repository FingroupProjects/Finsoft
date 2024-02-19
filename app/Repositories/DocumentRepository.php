<?php

namespace App\Repositories;

use App\DTO\DocumentDTO;
use App\Models\PreliminaryDocument;
use App\Models\PreliminaryGoodDocument;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DocumentRepository implements DocumentRepositoryInterface {

    public function index(int $status): Collection
    {
        return PreliminaryDocument::with('counterparty', 'organization', 'storage', 'author', 'counterparty_agreement')
            ->where('status_id', $status)
            ->get();
    }

    public function store(DocumentDTO $dto, int $status): PreliminaryDocument
    {
        return DB::transaction(function () use ($status, $dto) {
            $document = PreliminaryDocument::create([
                'doc_number' => $this->uniqueNumber(),
                'date' => $dto->date,
                'counterparty_id' => $dto->counterparty_id,
                'counterparty_agreement_id' => $dto->counterparty_agreement_id,
                'organization_id' => $dto->organization_id,
                'storage_id' => $dto->storage_id,
                'author_id' => $dto->author_id,
                'status_id' => $status
            ]);

            PreliminaryGoodDocument::insert($this->goodDocuments($dto->goods, $document));

            return $document;
        });
    }


    public function update(PreliminaryDocument $document, DocumentDTO $dto) :PreliminaryDocument
    {
       //
    }

    public function uniqueNumber() : string
    {
        $lastRecord = PreliminaryDocument::query()->orderBy('doc_number', 'desc')->first();

        if (! $lastRecord) {
            $lastNumber = 1;
        } else {
            $lastNumber = (int) $lastRecord->doc_number + 1;
        }

        return str_pad($lastNumber, 7, '0', STR_PAD_LEFT);
    }

    private function goodDocuments(array $goods, PreliminaryDocument $document): array
    {
        return array_map(function ($item) use ($document) {
            return [
                'good_id' => $item['good_id'],
                'amount' => $item['amount'],
                'price' => $item['price'],
                'preliminary_document_id' => $document->id
            ];
        }, $goods);
    }
}

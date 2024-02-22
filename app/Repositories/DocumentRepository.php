<?php

namespace App\Repositories;

use App\DTO\DocumentDTO;
use App\Models\Document;
use App\Models\GoodDocument;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DocumentRepository implements DocumentRepositoryInterface
{

    public function index(int $status): Collection
    {
        return Document::with('counterparty', 'organization', 'storage', 'author', 'counterparty_agreement')
            ->where('status_id', $status)
            ->get();
    }

    public function store(DocumentDTO $dto, int $status): Document
    {
        return DB::transaction(function () use ($status, $dto) {
            $document = Document::create([
                'doc_number' => $this->uniqueNumber(),
                'date' => $dto->date,
                'counterparty_id' => $dto->counterparty_id,
                'counterparty_agreement_id' => $dto->counterparty_agreement_id,
                'organization_id' => $dto->organization_id,
                'storage_id' => $dto->storage_id,
                'author_id' => $dto->author_id,
                'status_id' => $status
            ]);

            GoodDocument::insert($this->goodDocuments($dto->goods, $document));

            return $document;
        });
    }

    public function update(Document $document, DocumentDTO $dto) :Document
    {
       //
    }

    public function uniqueNumber() : string
    {
        $lastRecord = Document::query()->orderBy('doc_number', 'desc')->first();

        if (! $lastRecord) {
            $lastNumber = 1;
        } else {
            $lastNumber = (int) $lastRecord->doc_number + 1;
        }

        return str_pad($lastNumber, 7, '0', STR_PAD_LEFT);
    }

    private function goodDocuments(array $goods, Document $document): array
    {
        return array_map(function ($item) use ($document) {
            return [
                'good_id' => $item['good_id'],
                'amount' => $item['amount'],
                'price' => $item['price'],
                'document_id' => $document->id->toString(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }, $goods);
    }

    public function merge(string $doc_number)
    {
        try {

            Document::where('doc_number', $doc_number)->update(['active' => true]);

        } catch (Exception $e) {

            return $e->getMessage();

        }
    }

}

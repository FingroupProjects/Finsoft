<?php

namespace App\Repositories;

use App\DTO\CurrencyDTO;
use App\DTO\DocumentDTO;
use App\DTO\ExchangeRateDTO;
use App\Models\Currency;
use App\Models\Document;
use App\Models\ExchangeRate;
use App\Models\Good;
use App\Models\GoodDocument;
use App\Repositories\Contracts\CurrencyRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use \Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DocumentRepository implements DocumentRepositoryInterface {

    public function index(): Collection
    {
        return Document::all();
    }

    public function store(DocumentDTO $dto): Document
    {
        return DB::transaction(function () use ($dto) {
            $document = Document::create([
                'doc_number' => $this->uniqueNumber(),
                'date' => $dto->date,
                'counterparty_id' => $dto->counterparty_id,
                'counterparty_agreement_id' => $dto->counterparty_agreement_id,
                'organization_id' => $dto->organization_id,
                'storage_id' => $dto->storage_id,
                'author_id' => $dto->author_id
            ]);

            GoodDocument::insert($this->goodDocuments($dto->goods, $document));

            return $document;
        });
    }

    public function update(Document $document, DocumentDTO $dto) :Document
    {
       //
    }

    public function uniqueNumber() : string {
        $lastRecord = Document::query()->orderBy('doc_number', 'desc')->first();

        if (!$lastRecord) {
            $lastNumber = 1;
        } else {
            $lastNumber = (int) $lastRecord->doc_number + 1;
        }

        $formattedNumber = str_pad($lastNumber, 7, '0', STR_PAD_LEFT);

        return $formattedNumber;
    }

    private function goodDocuments(array $goods, Document $document): array
    {
        return array_map(function ($item) use ($document) {
            return [
                'good_id' => $item['good_id'],
                'amount' => $item['amount'],
                'price' => $item['price'],
                'document_id' => $document->id
            ];
        }, $goods);
    }
}

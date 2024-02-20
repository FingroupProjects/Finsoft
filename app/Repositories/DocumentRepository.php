<?php

namespace App\Repositories;

use App\DTO\DocumentDTO;
use App\Models\Document;
use App\Models\GoodDocument;
use App\Models\PreliminaryDocument;
use App\Models\PreliminaryGoodDocument;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use Carbon\Carbon;
use Exception;
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
                'preliminary_document_id' => $document->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }, $goods);
    }

    public function merge(string $doc_number)
    {
        try {
            $doc = PreliminaryDocument::where('doc_number', $doc_number)
                ->first()
                ->makeHidden(['send', 'created_at', 'updated_at'])
                ->toArray();

            $goods = PreliminaryGoodDocument::where('preliminary_document_id', $doc['id'])
                ->get()
                ->toArray();

            DB::transaction(function () use ($doc, $goods) {
                PreliminaryDocument::where('doc_number', $doc['doc_number'])->update(['send' => true]);
                Document::create($doc);
                GoodDocument::insert($this->prepareGoodsForMerge($goods));
            });

        } catch (Exception $e) {

            return $e->getMessage();

        }
    }

    public function prepareGoodsForMerge(array $goods)
    {
        return array_map(function ($good) {
            return [
                'good_id' => $good['good_id'],
                'amount' => $good['amount'],
                'price' => $good['price'],
                'document_id' => $good['preliminary_document_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }, $goods);
    }

}

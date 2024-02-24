<?php

namespace App\Repositories;

use App\DTO\DocumentDTO;
use App\Models\Document;
use App\Models\GoodDocument;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use App\Traits\FilterTrait;
use App\Traits\Sort;
use Carbon\Carbon;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DocumentRepository implements DocumentRepositoryInterface
{
    use FilterTrait, Sort;

    public $model = Document::class;

    public function index(int $status, array $data): LengthAwarePaginator
    {
        $query = $this->model::search($data['search'])->where('status_id', $status);

        $filteredParams = $this->processSearchData($data);

        $query = $this->sort($filteredParams, $query, ['counterparty', 'organization', 'storage', 'author', 'counterparty_agreement']);

        return $query->paginate($filteredParams['itemsPerPage']);
    }

    public function store(DocumentDTO $dto, int $status): Document
    {
        return DB::transaction(function () use ($status, $dto) {
            $document = Document::create([
                'doc_number' => $this->uniqueNumber(),
                'date' => Carbon::parse($dto->date),
                'counterparty_id' => $dto->counterparty_id,
                'counterparty_agreement_id' => $dto->counterparty_agreement_id,
                'organization_id' => $dto->organization_id,
                'storage_id' => $dto->storage_id,
                'author_id' => $dto->author_id,
                'status_id' => $status
            ]);

            if (!is_null($dto->goods))
            {
                GoodDocument::insert($this->insertGoodDocuments($dto->goods, $document));
            }

        });
    }

    public function update(Document $document, DocumentDTO $dto) :Document
    {
        return DB::transaction(function () use ($dto) {
            $document = Document::create([
                'date' => Carbon::parse($dto->date),
                'counterparty_id' => $dto->counterparty_id,
                'counterparty_agreement_id' => $dto->counterparty_agreement_id,
                'organization_id' => $dto->organization_id,
                'storage_id' => $dto->storage_id,
                'author_id' => $dto->author_id
            ]);

            if (!is_null($dto->goods))
            {
                GoodDocument::insertOrUpdate($this->insertGoodDocuments($dto->goods, $document));
            }

        });
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

    private function insertGoodDocuments(array $goods, Document $document): array
    {
        return array_map(function ($item) use ($document) {
            return [
                'good_id' => $item['good_id'],
                'amount' => $item['amount'],
                'price' => $item['price'],
                'document_id' => $document->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }, $goods);
    }

    public function approve(Document $document)
    {
        $document->update(['active' => true]);
    }

}

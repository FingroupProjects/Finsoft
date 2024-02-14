<?php

namespace App\DTO;

use App\Http\Requests\Api\Document\DocumentRequest;

class DocumentDTO
{
    public function __construct(public string $date, public int $counterparty_id, public int $counterparty_agreement_id, public int $organization_id,
                                public int $storage_id, public int $author_id, public array $goods) { }

    public static function fromRequest(DocumentRequest $request)
    {
        return new static(
            $request->get('date'),
            $request->get('counterparty_id'),
            $request->get('counterparty_agreement_id'),
            $request->get('organization_id'),
            $request->get('storage_id'),
            $request->get('author_id'),
            $request->get('goods'),
        );
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'doc_number' => $this->doc_number,
            'date' => $this->date,
            'counterparty' => $this->counterparty->name ?? '',
            'counterparty_agreement' => $this->counterparty_agreement->name ?? '',
            'organization' => $this->organization->name ?? '',
            'storage' => $this->storage->name ?? '',
            'author' => $this->author->name ?? ''
        ];
    }
}

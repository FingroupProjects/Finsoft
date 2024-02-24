<?php

namespace App\Observers;

use App\Enums\DocumentHistoryStatuses;
use App\Models\ChangeHistory;
use App\Models\Document;
use App\Models\DocumentHistory;
use Illuminate\Support\Facades\Auth;

class DocumentObserver
{
    public function created(Document $model): void
    {
        DocumentHistory::create([
            'status' => DocumentHistoryStatuses::CREATED,
            'user_id' => Auth::user()->id,
            'document_id' => $model->id,
        ]);
    }


    public function updated(Document $model): void
    {
        if ($model->getDirty() == 'status') {
            DocumentHistory::create([
                'status' => DocumentHistoryStatuses::APPROVED,
                'user_id' => Auth::user()->id,
                'document_id' => $model->id,
            ]);

        } else {
            $documentHistory = DocumentHistory::create([
                'status' => DocumentHistoryStatuses::UPDATED,
                'user_id' => Auth::user()->id,
                'document_id' => $model->id,
            ]);


            $this->track($model, $documentHistory);
        }

    }


    public function deleted(Document $model): void
    {
        DocumentHistory::create([
            'status' => DocumentHistoryStatuses::DELETED,
            'user_id' => Auth::user()->id,
            'document_id' => $model->id,
        ]);
    }


    public function restored(Document $model): void
    {
        DocumentHistory::create([
            'status' => DocumentHistoryStatuses::RESTORED,
            'user_id' => Auth::user()->id,
            'document_id' => $model->id,
        ]);
    }

    public function forceDeleted(Document $model): void
    {
        DocumentHistory::create([
            'status' => DocumentHistoryStatuses::FORCE_DELETED,
            'user_id' => Auth::user()->id,
            'document_id' => $model->id,
        ]);
    }

    private function track(Document $document, DocumentHistory $history, callable $func = null) :void
    {
        $func = $func ?: [$this, 'getHistoryBody'];

        $this->getUpdated($document)
            ->map(function ($value, $field) use ($func) {
                return call_user_func_array($func, [$value, $field]);
            })
            ->each(function ($fields) use ($document, $history) {
                ChangeHistory::create([
                        'document_id' => $history->id->toString()
                    ] + $fields);
            });
    }

    private function getHistoryBody($value, $field)
    {
        return [
            'body' => "Обновлено {$field} на ${value}",
        ];
    }

    private function getUpdated($model)
    {
        return collect($model->getDirty())->filter(function ($value, $key) {
            return !in_array($key, ['created_at', 'updated_at']);
        })->mapWithKeys(function ($value, $key) {
            return [str_replace('_', ' ', $key) => $value];
        });
    }
}

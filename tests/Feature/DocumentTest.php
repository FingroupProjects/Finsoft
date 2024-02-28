<?php

namespace Tests\Feature;

use App\DTO\DocumentDTO;
use App\Enums\DocumentHistoryStatuses;
use App\Models\ChangeHistory;
use App\Models\Counterparty;
use App\Models\CounterpartyAgreement;
use App\Models\Document;
use App\Models\DocumentHistory;
use App\Models\Good;
use App\Models\Organization;
use App\Models\Storage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\Rule;
use Tests\TestCase;

class DocumentTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /**
     * A basic feature test example.
     */
    public function test_retrieve_documents(): void
    {
        $this
            ->actingAs($this->user, 'sanctum')
            ->get('api/document/provider/purchaseList')
            ->assertOk();
    }

    public function test_create_document(): void
    {
        $this
            ->actingAs($this->user, 'sanctum')
            ->post('api/document/provider/purchase', [
                'organization_id' => Organization::factory()->create()->id,
                'date' => "2023-12-12",
                'counterparty_id' => Counterparty::factory()->create()->id,
                'counterparty_agreement_id' => CounterpartyAgreement::factory()->create()->id,
                'storage_id' => Storage::factory()->create()->id,
                'author_id' => $this->user->id,
                'goods' => [
                    [
                        'good_id' => Good::factory()->create()->id,
                        'amount' => rand(1, 50),
                        'price' => rand(10, 1000)
                    ],
                    [
                        'good_id' => Good::factory()->create()->id,
                        'amount' => rand(10, 100),
                        'price' => rand(10, 10000)
                    ],
                    [
                        'good_id' => Good::factory()->create()->id,
                        'amount' => rand(10, 100),
                        'price' => rand(10, 10000)
                    ]
                ]
            ])
            ->assertStatus(201);
    }

    public function test_edit_document(): void
    {
        $document = Document::factory()->create();

        $this->actingAs($this->user, 'sanctum')
            ->patch('api/document/update/' . $document->id, [
                'organization_id' => Organization::factory()->create()->id,
                'date' => Carbon::today(),
                'counterparty_id' => Counterparty::factory()->create()->id,
                'counterparty_agreement_id' => CounterpartyAgreement::factory()->create()->id,
                'storage_id' => Storage::factory()->create()->id,
                'author_id' => $this->user->id
            ])
            ->assertStatus(200);

        $has_history_saved = DocumentHistory::where('document_id', $document->id)
            ->where('status', DocumentHistoryStatuses::UPDATED)
            ->exists();

        $this->assertTrue($has_history_saved);

    }

    public function test_approve_document()
    {
        $document = Document::factory()->create();

        $this->actingAs($this->user, 'sanctum')
            ->get('api/document/approve/' . $document->id)
            ->assertOk();

        $has_history_saved = DocumentHistory::where('document_id', $document->id)
            ->where('status', DocumentHistoryStatuses::APPROVED)
            ->exists();

        $this->assertTrue($has_history_saved);
    }
//
//    public function test_un_approve_document()
//    {
//        $document = Document::factory()->create();
//
//        $this->actingAs($this->user, 'sanctum')
//            ->get('api/document/unApprove/' . $document->id)
//            ->assertOk();
//
//
//        $has_history_saved = DocumentHistory::where('document_id', $document->id)
//            ->where('status', DocumentHistoryStatuses::UNAPPROVED)
//            ->exists();
//
//        $this->assertTrue($has_history_saved);
//
//    }


    public function test_document_can_be_deleted()
    {
        $document = Document::factory()->create();

        $this->assertTrue($document->delete());

        $has_history_saved = DocumentHistory::where('document_id', $document->id)
            ->where('status', DocumentHistoryStatuses::DELETED)
            ->exists();

        $this->assertTrue($has_history_saved);
    }

    public function test_document_can_be_restored()
    {
        $document = Document::factory()->create();

        $this->assertTrue($document->delete());
        $this->assertTrue($document->restore());

        $has_history_saved = DocumentHistory::where('document_id', $document->id)
            ->where('status', DocumentHistoryStatuses::RESTORED)
            ->exists();

        $this->assertTrue($has_history_saved);
    }


}

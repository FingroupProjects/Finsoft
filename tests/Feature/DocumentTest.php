<?php

namespace Tests\Feature;

use App\DTO\DocumentDTO;
use App\Enums\DocumentHistoryStatuses;
use App\Models\ChangeHistory;
use App\Models\Counterparty;
use App\Models\CounterpartyAgreement;
use App\Models\Document;
use App\Models\DocumentHistory;
use App\Models\Organization;
use App\Models\Status;
use App\Models\Storage;
use App\Models\User;
use App\Repositories\DocumentRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Validation\Rule;
use Tests\TestCase;

class DocumentTest extends TestCase
{
    private User $user;

    private Document $document;

    private DocumentHistory $documentHistory;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = User::factory()->create();
        $this->document = Document::factory()->create();

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

            ])
            ->assertStatus(201);
    }

    public function test_edit_document(): void
    {

        $this->actingAs($this->user, 'sanctum')
            ->patch('api/document/update/' . $this->document->id, [
                'organization_id' => Organization::factory()->create()->id,
                'date' => Carbon::today(),
                'counterparty_id' => Counterparty::factory()->create()->id,
                'counterparty_agreement_id' => CounterpartyAgreement::factory()->create()->id,
                'storage_id' => Storage::factory()->create()->id,
                'author_id' => $this->user->id
            ])
            ->assertStatus(200);

    }

    public function test_has_history_saved()
    {
        $has_history_saved =  DocumentHistory::where('document_id', $this->document->id)
            ->where('status', DocumentHistoryStatuses::UPDATED)
            ->exists();

        $this->assertTrue($has_history_saved);
    }

    public function test_approve_document()
    {
        $document =
    }


    public function test_can_be_deleted()
    {
        $document = Document::factory()->create();


       $this->assertTrue($document->delete());

        $has_history_saved =  DocumentHistory::where('document_id', $document->id)
            ->where('status', DocumentHistoryStatuses::DELETED)
            ->exists();

        $this->assertTrue($has_history_saved);

    }




}
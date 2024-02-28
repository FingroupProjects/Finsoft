<?php

namespace Tests\Feature;

use App\Models\Position;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }


    public function test_retrieve_employee(): void
    {
        $this->actingAs($this->user)
            ->get('/api/employee')
            ->assertOk();
    }

    public function test_store_employee()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->actingAs($this->user)
            ->post('/api/employee', [
                'name' => 'name',
                'lastname' => 'lastname',
                'surname' => 'surname',
                'image' => $file,
                'position_id' => Position::factory()
            ]);
        Storage::disk('employeePhoto')->assertExists($file->hashName());
    }







}

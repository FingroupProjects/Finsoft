<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('doc_number')->unique();
            $table->date('date');
            $table->foreignId('counterparty_id')->constrained();
            $table->foreignId('counterparty_agreement_id')->constrained();
            $table->foreignId('organization_id')->constrained();
            $table->foreignId('storage_id')->constrained();
            $table->foreignId('author_id')->constrained('users');
            $table->boolean('active') ->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};

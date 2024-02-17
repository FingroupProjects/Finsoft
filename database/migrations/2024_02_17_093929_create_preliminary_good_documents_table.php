<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('preliminary_good_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('good_id')->constrained();
            $table->integer('amount');
            $table->decimal('price',10,2);
            $table->foreignId('preliminary_document_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preliminary_good_documents');
    }
};

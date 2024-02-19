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
        Schema::create('organization_bills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('currency_id')->constrained();
            $table->foreignId('organization_id')->constrained();
            $table->string('bill_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_billls');
    }
};

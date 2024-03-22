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
        Schema::create('domain_not_corrects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('not_correct_id')->references('id')->on('domain_corrects')->constrained();
            $table->string('address', 100)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domain_not_corrects');
    }
};

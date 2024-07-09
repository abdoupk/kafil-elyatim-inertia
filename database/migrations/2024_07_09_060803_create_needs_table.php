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
        Schema::create('needs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('demand');
            $table->text('status');
            $table->text('needable_type');
            $table->uuid('needable_id');
            $table->text('tenant_id');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->index(['needable_type', 'needable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('needs');
    }
};

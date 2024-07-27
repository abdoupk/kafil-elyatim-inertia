<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_occurrence_orphan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('orphan_id')->constrained();
            $table->foreignUuid('event_occurrence_id')->constrained();
            $table->uuid('tenant_id')->index('idx_event_occurrence_orphan_tenant_id');
            $table->uuid('lesson_id')->index('idx_event_occurrence_orphan_lesson_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_occurrence_orphan');
    }
};

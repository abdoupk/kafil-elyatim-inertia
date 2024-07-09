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
        Schema::create('sponsors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('first_name');
            $table->text('last_name');
            $table->text('phone_number');
            $table->text('sponsor_type');
            $table->date('birth_date');
            $table->text('father_name');
            $table->text('mother_name');
            $table->text('birth_certificate_number');
            $table->text('academic_level');
            $table->text('function');
            $table->text('health_status');
            $table->text('diploma')->nullable();
            $table->text('card_number')->nullable();
            $table->text('ccp')->nullable();
            $table->text('gender');
            $table->uuid('family_id');
            $table->text('tenant_id')->index('idx_sponsors_tenant_id');
            $table->uuid('created_by')->index('idx_sponsors_created_by');
            $table->uuid('deleted_by')->nullable()->index('idx_sponsors_deleted_by');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsors');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sponsors', static function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->foreignUuid('zone')->nullable(false);
            $table->integer('file_number')->nullable(false);
            $table->date('start_date')->nullable(false);
            $table->text('name')->nullable(false);
            $table->text('address')->nullable(false);
            $table->text('phone_number')->nullable(false);
            $table->text('sponsorship_type')->nullable(false);
            $table->date('birth_date')->nullable(false);
            $table->text('father_name')->nullable(false);
            $table->text('mother_name')->nullable(false);
            $table->text('birth_certificate')->nullable(false);
            $table->text('academic_level')->nullable(false);
            $table->text('function')->nullable(false);
            $table->text('health_status')->nullable(false);
            $table->text('diploma')->nullable();
            $table->foreignUuid('tenant_id')->nullable(false);
            $table->uuid('created_by')->nullable(false);
            $table->uuid('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sponsors');
    }
};

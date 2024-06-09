<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orphans', static function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->text('first_name')->nullable(false);
            $table->text('last_name')->nullable(false);
            $table->date('birth_date')->nullable(false);
            $table->text('family_status')->nullable(false);
            $table->text('health_status')->nullable(false);
            $table->text('academic_level')->nullable(false);
            $table->text('shoes_size')->nullable(false);
            $table->text('pants_size')->nullable(false);
            $table->text('shirt_size')->nullable(false);
            $table->text('note')->nullable(false);
            $table->text('tenant_id')->nullable(false);
            $table->uuid('family_id')->nullable(false);
            $table->uuid('created_by')->nullable(false);
            $table->uuid('deleted_by')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
            $table->foreign('family_id')->references('id')->on('families');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orphans');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spouses', static function (Blueprint $table) {
            $table->text('first_name')->nullable(false);
            $table->text('last_name')->nullable(false);
            $table->date('birth_date')->nullable(false);
            $table->date('death_date')->nullable(false);
            $table->text('function')->nullable(false);
            $table->double('income')->nullable(false);
            $table->uuid('family_id')->nullable(false);
            $table->text('tenant_id')->nullable(false);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade');
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spouses');
    }
};

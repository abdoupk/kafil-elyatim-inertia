<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vocational_training_achievements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('note');
            $table->uuid('orphan_id');
            $table->uuid('tenant_id');
            $table->foreign('orphan_id')->references('id')->on('orphans');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->integer('year');
            $table->integer('vocational_training_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vocational_training_achievements');
    }
};

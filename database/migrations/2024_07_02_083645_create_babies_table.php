<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('babies', function (Blueprint $table) {
            $table->id();
            $table->integer('baby_milk_quantity')->nullable();
            $table->string('baby_milk_type')->nullable();
            $table->integer('diapers_quantity')->nullable();
            $table->string('diapers_type')->nullable();
            $table->uuid('tenant_id');
            $table->uuid('orphan_id');
            $table->uuid('family_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('babies');
    }
};

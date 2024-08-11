<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->string('occasion');
            $table->foreignUuid('tenant_id')->references('id')->on('tenants');
            $table->integer('families_count');
            $table->json('family_ids');
            $table->string('saved_month');
            $table->foreignUuid('saved_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};

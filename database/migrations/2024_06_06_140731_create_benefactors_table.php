<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('benefactors', static function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('tenant_id')->nullable(false);
            $table->timestamp('deleted_at', 0)->nullable();
            $table->timestamp('created_at', 0)->nullable();
            $table->timestamp('updated_at', 0)->nullable();

            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('benefactors');
    }
};

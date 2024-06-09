<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('income_sponsor', static function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->uuid('income_id')->nullable(false);
            $table->uuid('sponsor_id')->nullable(false);
            $table->text('tenant_id')->nullable(false);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('income_id')->references('id')->on('incomes')->onDelete('cascade');
            $table->foreign('sponsor_id')->references('id')->on('sponsors')->onDelete('cascade');
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('income_sponsor');
    }
};

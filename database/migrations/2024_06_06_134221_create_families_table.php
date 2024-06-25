<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('families', static function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->text('name')->nullable(false);
            $table->text('zone_id')->nullable(false);
            $table->text('tenant_id')->nullable(false);
            $table->timestamps();

            $table->foreign('tenant_id')->references('id')->on('tenants')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('families');
    }
};

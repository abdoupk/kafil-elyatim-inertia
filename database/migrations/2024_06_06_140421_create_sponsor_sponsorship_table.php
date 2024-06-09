<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sponsor_sponsorship', static function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->uuid('sponsor_id')->nullable(false);
            $table->uuid('sponsorship_id')->nullable(false);
            $table->enum('type', [
                'guaranteed_medical',
                'support_the_draft',
                'literacy_classes',
                'direct_sponsorship',
                'other',
            ])->nullable(false);
            $table->text('value')->nullable(false);
            $table->text('tenant_id')->nullable(false);
            $table->timestamp('created_at', 0)->nullable();
            $table->timestamp('updated_at', 0)->nullable();

            $table->foreign('sponsor_id')->references('id')->on('sponsors')->onDelete('cascade');
            $table->foreign('sponsorship_id')->references('id')->on('sponsorships')->onDelete('cascade');
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sponsor_sponsorship');
    }
};

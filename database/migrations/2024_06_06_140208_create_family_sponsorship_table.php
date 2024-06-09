<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('family_sponsorship', static function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->uuid('family_id')->nullable(false);
            $table->uuid('sponsorship_id')->nullable(false);
            $table->enum('type', [
                'ramadan_basket',
                'monthly_expense',
                'eid_al_adha',
                'zakat',
                'housing_assistance',
                'other',
            ])->nullable(false);
            $table->text('value')->nullable(false);
            $table->text('tenant_id')->nullable(false);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade');
            $table->foreign('sponsorship_id')->references('id')->on('sponsorships')->onDelete('cascade');
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('family_sponsorship');
    }
};

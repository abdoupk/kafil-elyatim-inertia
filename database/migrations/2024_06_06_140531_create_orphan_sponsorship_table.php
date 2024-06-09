<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orphan_sponsorship', static function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->uuid('orphan_id')->nullable(false);
            $table->uuid('sponsorship_id')->nullable(false);
            $table->enum('type', [
                'school_bag',
                'private_lessons',
                'eid_suit',
                'summer_camp',
                'college_trips',
                'fellowship',
                'guaranteed_medical',
                'other',
            ])->nullable(false);
            $table->text('value')->nullable(false);
            $table->text('tenant_id')->nullable(false);
            $table->timestamp('created_at', 0)->nullable();
            $table->timestamp('updated_at', 0)->nullable();

            $table->foreign('orphan_id')->references('id')->on('orphans')->onDelete('cascade');
            $table->foreign('sponsorship_id')->references('id')->on('sponsorships')->onDelete('cascade');
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orphan_sponsorship');
    }
};

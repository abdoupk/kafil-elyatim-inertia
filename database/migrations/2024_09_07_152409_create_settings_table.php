<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->index('idx_settings_user_id');
            $table->jsonb('notifications')->nullable();
            $table->text('locale');
            $table->uuid('tenant_id');
            $table->timestamps();

            $table->index(['id'], 'idx_settings_id');
        });
        DB::statement("alter table \"settings\" add column \"theme\" theme not null");
        DB::statement("alter table \"settings\" add column \"color_scheme\" color_scheme not null");
        DB::statement("alter table \"settings\" add column \"layout\" layout not null");
        DB::statement("alter table \"settings\" add column \"appearance\" appearance not null");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

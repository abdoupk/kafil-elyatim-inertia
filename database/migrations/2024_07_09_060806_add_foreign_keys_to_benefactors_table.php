<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('benefactors', function (Blueprint $table) {
            $table->foreign(['tenant_id'], 'benefactors_tenant_id_fkey')->references(['id'])->on('tenants')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('benefactors', function (Blueprint $table) {
            $table->dropForeign('benefactors_tenant_id_fkey');
        });
    }
};

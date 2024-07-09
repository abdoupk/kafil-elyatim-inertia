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
        Schema::create('atdatabases_migrations_applied', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('index');
            $table->text('name');
            $table->text('script');
            $table->timestampTz('applied_at');
            $table->text('ignored_error')->nullable();
            $table->boolean('obsolete');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atdatabases_migrations_applied');
    }
};

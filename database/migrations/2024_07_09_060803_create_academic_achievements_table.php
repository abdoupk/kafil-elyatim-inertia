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
        Schema::create('academic_achievements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('academic_level')->nullable();
            $table->text('academic_phase')->nullable();
            $table->integer('academic_year')->nullable();
            $table->float('first_trimester')->nullable();
            $table->float('second_trimester')->nullable();
            $table->float('third_trimester')->nullable();
            $table->float('first_semester')->nullable();
            $table->float('second_semester')->nullable();
            $table->float('average')->nullable();
            $table->uuid('orphan_id');
            $table->text('tenant_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_achievements');
    }
};

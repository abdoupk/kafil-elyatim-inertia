<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academic_achievements', function (Blueprint $table) {
            $table->id();
            $table->string('academic_level');
            $table->double('first_trimester')->nullable();
            $table->double('second_trimester')->nullable();
            $table->double('third_trimester')->nullable();
            $table->double('first_semester')->nullable();
            $table->double('second_semester')->nullable();
            $table->double('total')->nullable();
            $table->uuid('orphan_id');
            $table->uuid('tenant_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_achievements');
    }
};

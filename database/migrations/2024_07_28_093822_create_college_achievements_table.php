<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('college_achievements', function (Blueprint $table) {
            $table->id();
            $table->uuid('orphan_id');
            $table->double('first_semester');
            $table->string('second_semester');
            $table->string('speciality');
            $table->string('university');
            $table->string('note');
            $table->uuid('tenant_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('college_achievements');
    }
};

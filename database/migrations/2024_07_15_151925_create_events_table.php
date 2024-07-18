<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('description');
            $table->uuid('school_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('color');
            $table->tinyInteger('interval');
            $table->string('frequency');
            $table->date('until');
            $table->uuid('tenant_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

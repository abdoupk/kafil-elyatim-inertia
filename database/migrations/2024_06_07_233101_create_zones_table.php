<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('zones', static function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->string('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zones');
    }
};

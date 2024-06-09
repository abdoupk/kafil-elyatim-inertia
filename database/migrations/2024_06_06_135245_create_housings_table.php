<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('housings', static function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->text('name')->nullable(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('housings');
    }
};

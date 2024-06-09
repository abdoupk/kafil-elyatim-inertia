<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('family_housing', static function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->uuid('family_id')->nullable(false);
            $table->uuid('housing_id')->nullable(false);
            $table->text('value')->nullable(false);

            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade');
            $table->foreign('housing_id')->references('id')->on('housings')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('family_housing');
    }
};

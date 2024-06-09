<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('family_furnishing', static function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('family_id')->nullable(false);
            $table->uuid('furnishing_id')->nullable(false);
            $table->text('value')->nullable(false);

            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade');
            $table->foreign('furnishing_id')->references('id')->on('furnishings')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('family_furnishing');
    }
};

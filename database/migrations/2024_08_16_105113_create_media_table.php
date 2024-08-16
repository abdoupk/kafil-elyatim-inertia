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
        Schema::create('media', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('model_type');
            $table->bigInteger('model_id');
            $table->uuid('uuid')->nullable();
            $table->text('collection_name');
            $table->text('name');
            $table->text('file_name');
            $table->text('mime_type')->nullable();
            $table->text('disk');
            $table->text('conversions_disk')->nullable();
            $table->bigInteger('size');
            $table->jsonb('manipulations');
            $table->jsonb('custom_properties');
            $table->jsonb('generated_conversions');
            $table->jsonb('responsive_images');
            $table->integer('order_column')->nullable()->index();
            $table->timestamps();

            $table->index(['model_type', 'model_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};

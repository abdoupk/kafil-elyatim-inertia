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
            $table->text('value')->nullable(false);
            $table->text('housing_receipt_number')->nullable();
            $table->integer('number_of_rooms')->nullable();
            $table->text('other_properties')->nullable();
            $table->uuid('family_id')->nullable(false);
            $table->uuid('tenant_id')->nullable(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('housings');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('furnishings', static function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->text('television')->nullable(false);
            $table->text('refrigerator')->nullable(false);
            $table->text('fireplace')->nullable(false);
            $table->text('washing_machine')->nullable(false);
            $table->text('water_heater')->nullable(false);
            $table->text('oven')->nullable(false);
            $table->text('wardrobe')->nullable(false);
            $table->text('cupboard')->nullable(false);
            $table->text('covers')->nullable(false);
            $table->text('mattresses')->nullable(false);
            $table->text('other_furnishings')->nullable(false);
            $table->uuid('family_id')->nullable(false);
            $table->uuid('tenant_id')->nullable(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('furnishings');
    }
};

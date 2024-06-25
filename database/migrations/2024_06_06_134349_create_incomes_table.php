<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incomes', static function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->text('cnr')->nullable(false);
            $table->text('cnas')->nullable(false);
            $table->text('casnos')->nullable(false);
            $table->text('pension')->nullable(false);
            $table->text('account')->nullable(false);
            $table->text('other_income')->nullable(false);
            $table->uuid('sponsor_id')->nullable(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};

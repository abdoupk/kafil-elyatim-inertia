<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cities', static function (Blueprint $table) {
            $table->id();
            $table->text('commune_name', 120);
            $table->text('commune_name_ascii', 120);
            $table->text('daira_name', 120);
            $table->text('daira_name_ascii', 120);
            $table->text('wilaya_code', 4);
            $table->text('wilaya_name', 120);
            $table->text('wilaya_name_ascii', 120);
            $table->text('latitude', 12);
            $table->text('longitude', 12);
            $table->text('post_code', 5);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};

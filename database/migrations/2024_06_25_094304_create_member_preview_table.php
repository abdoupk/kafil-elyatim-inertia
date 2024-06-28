<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('member_preview', static function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->uuid('user_id');
            $table->uuid('preview_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('member_preview');
    }
};

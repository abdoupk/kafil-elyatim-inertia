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
        Schema::table('lesson_orphan', function (Blueprint $table) {
            $table->foreign(['lesson_id'], 'lesson_orphan_lesson_id_fkey')->references(['id'])->on('lessons')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['orphan_id'], 'lesson_orphan_orphan_id_fkey')->references(['id'])->on('orphans')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lesson_orphan', function (Blueprint $table) {
            $table->dropForeign('lesson_orphan_lesson_id_fkey');
            $table->dropForeign('lesson_orphan_orphan_id_fkey');
        });
    }
};

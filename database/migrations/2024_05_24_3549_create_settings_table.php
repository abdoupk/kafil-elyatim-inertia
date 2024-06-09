\App\Enums\Theme::cases()<?php

use App\Enums\Appearance;
use App\Enums\ColorScheme;
use App\Enums\Layout;
use App\Enums\Theme;
use App\Models\User;
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
        Schema::create('settings', static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->enum('theme', Theme::cases());
            $table->enum('appearance', Appearance::cases());
            $table->enum('color_scheme', ColorScheme::cases());
            $table->enum('layout', Layout::cases());
            $table->json('notifications')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('second_sponsors', callback: static function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->text('first_name')->nullable(false);
            $table->text('last_name')->nullable(false);
            $table->text('degree_of_kinship')->nullable(false);
            $table->text('phone_number')->nullable(false);
            $table->text('address')->nullable(false);
            $table->double('income')->nullable(false);
            $table->uuid('family_id')->nullable(false);
            $table->text('tenant_id')->nullable(false);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade');
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('second_sponsors');
    }
};

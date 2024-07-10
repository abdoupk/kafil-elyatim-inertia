<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('finances', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->double('amount');
            $table->string('description')->nullable();
            $table->dateTime('date');
            $table->enum('specification', ['drilling_wells', 'monthly_sponsorship', 'eid_el_adha', 'eid_el_fitr',
                'other', 'school_entry', 'analysis', 'therapy', 'ramadan_basket']);
            $table->uuid('created_by');
            $table->uuid('tenant_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finances');
    }
};

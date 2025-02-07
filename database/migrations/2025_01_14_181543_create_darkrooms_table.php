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
        Schema::create('darkrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->time('opening_time');
            $table->time('closing_time');
            $table->boolean('is_operational')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('darkrooms');
    }
};

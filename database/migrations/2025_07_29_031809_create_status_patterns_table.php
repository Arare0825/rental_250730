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
        Schema::create('status_patterns', function (Blueprint $table) {
            $table->id();
            $table->char('hid', 25);
            $table->char('status_pattern', 255);
            $table->char('status', 25);
            $table->char('status_name', 25);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_patterns');
    }
};

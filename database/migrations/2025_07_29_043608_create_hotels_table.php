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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('hid');
            $table->integer('status_pattern');
            $table->string('open_time');
            $table->string('close_time');
            $table->boolean('allday_active');
            $table->string('explain_text_ja');
            $table->string('explain_text_en');
            $table->string('order_text_ja');
            $table->string('order_text_en');
            $table->timestamps();
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};

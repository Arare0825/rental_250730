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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->char('hid',length: 25);
            $table->char('item_name_ja',length: 255);
            $table->char('item_name_en',length: 255)->nullable();
            $table->integer('sort');
            $table->integer('stock');
            $table->boolean('visible');
            $table->char('i_name',length: 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

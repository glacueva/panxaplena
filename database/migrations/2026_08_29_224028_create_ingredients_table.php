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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ingredient_category_id');
            $table->string('name')->unique();
            $table->enum('unit', ['kg', 'g', 'mg', 'u', 'l', 'cl', 'ml']);
            $table->timestamps();

            $table->foreign('ingredient_category_id')->references('id')->on('ingredient_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};

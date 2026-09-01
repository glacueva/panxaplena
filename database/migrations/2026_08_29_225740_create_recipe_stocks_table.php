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
        Schema::create('recipe_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recipe_id');
            $table->unsignedBigInteger('stock_type_id');
            $table->float('recipe_quantity');
            $table->timestamps();

            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->foreign('stock_type_id')->references('id')->on('stock_types');
            $table->unique(['recipe_id', 'stock_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_stocks');
    }
};

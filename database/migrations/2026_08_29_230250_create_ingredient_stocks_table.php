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
        Schema::create('ingredient_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ingredient_id');
            $table->unsignedBigInteger('stock_type_id');
            $table->float('ingredient_quantity');
            $table->timestamps();

            $table->foreign('ingredient_id')->references('id')->on('ingredients');
            $table->foreign('stock_type_id')->references('id')->on('stock_types');
            $table->unique(['recipe_id', 'stock_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredient_stocks');
    }
};

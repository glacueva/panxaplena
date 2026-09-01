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
        Schema::create('menu_recipes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('recipe_id');
            $table->float('recipe_quantity');
            $table->enum('day_of_week', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
            $table->enum('meal', ['breakfast', 'second_breakfast', 'lunch', 'snack', 'dinner']);
            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('menus');
            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->unique(['menu_id', 'recipe_id', 'day_of_week', 'meal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_recipes');
    }
};

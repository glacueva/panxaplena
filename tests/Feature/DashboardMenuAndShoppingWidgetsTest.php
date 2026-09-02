<?php

use App\Models\Ingredient;
use App\Services\CurrentMenuData;
use App\Models\IngredientCategory;
use App\Models\Menu;
use App\Models\MenuRecipe;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    Schema::create('ingredient_categories', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });

    Schema::create('ingredients', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('unit')->nullable();
        $table->unsignedBigInteger('ingredient_category_id');
        $table->timestamps();
    });

    Schema::create('recipes', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });

    Schema::create('recipe_ingredients', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('recipe_id');
        $table->unsignedBigInteger('ingredient_id');
        $table->float('ingredient_quantity');
        $table->timestamps();
    });

    Schema::create('menus', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });

    Schema::create('menu_recipes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('menu_id');
        $table->unsignedBigInteger('recipe_id');
        $table->integer('recipe_quantity');
        $table->string('day_of_week');
        $table->string('meal');
        $table->timestamps();
    });
});

afterEach(function () {
    Schema::dropIfExists('menu_recipes');
    Schema::dropIfExists('menus');
    Schema::dropIfExists('recipe_ingredients');
    Schema::dropIfExists('recipes');
    Schema::dropIfExists('ingredients');
    Schema::dropIfExists('ingredient_categories');
});

it('builds dashboard rows for the current menu and shopping list', function () {
    $category = IngredientCategory::create(['name' => 'Verduras']);
    $ingredient = Ingredient::create([
        'name' => 'Tomate',
        'unit' => 'kg',
        'ingredient_category_id' => $category->id,
    ]);

    $recipe = Recipe::create(['name' => 'Ensalada']);
    RecipeIngredient::create([
        'recipe_id' => $recipe->id,
        'ingredient_id' => $ingredient->id,
        'ingredient_quantity' => 1.5,
    ]);

    $menu = Menu::create(['name' => 'Semana 1']);
    MenuRecipe::create([
        'menu_id' => $menu->id,
        'recipe_id' => $recipe->id,
        'recipe_quantity' => 2,
        'day_of_week' => 'monday',
        'meal' => 'lunch',
    ]);

    expect(CurrentMenuData::menuRows($menu))->toBe([
        [
            'day' => 'monday',
            'meal' => 'lunch',
            'recipes' => 'Ensalada',
            'quantity' => 2,
        ],
    ])->and(CurrentMenuData::shoppingRows($menu))->toBe([
        [
            'category' => 'Verduras',
            'ingredient' => 'Tomate',
            'qty' => '3kg',
        ],
    ]);
});

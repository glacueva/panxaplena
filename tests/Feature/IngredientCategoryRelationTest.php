<?php

use App\Models\Ingredient;
use App\Models\IngredientCategory;
use App\Models\Menu;
use App\Models\MenuRecipe;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('stores the ingredient category using the foreign key relationship', function () {
    $category = IngredientCategory::create(['name' => 'Verduras']);

    $ingredient = Ingredient::create([
        'name' => 'Tomate',
        'unit' => 'kg',
        'ingredient_category_id' => $category->id,
    ]);

    expect($ingredient->ingredient_category_id)->toBe($category->id)
        ->and($ingredient->ingredientCategory)->not->toBeNull()
        ->and($ingredient->ingredientCategory->id)->toBe($category->id);
});

it('groups the shopping list ingredients by category on the welcome page', function () {
    $category = IngredientCategory::create(['name' => 'Verduras']);

    $ingredient = Ingredient::create([
        'name' => 'Tomate',
        'unit' => 'kg',
        'ingredient_category_id' => $category->id,
    ]);

    $recipe = Recipe::create(['name' => 'Ensalada mixta']);

    RecipeIngredient::create([
        'recipe_id' => $recipe->id,
        'ingredient_id' => $ingredient->id,
        'ingredient_quantity' => 2,
    ]);

    $menu = Menu::create(['name' => 'Menú prueba']);

    MenuRecipe::create([
        'menu_id' => $menu->id,
        'recipe_id' => $recipe->id,
        'recipe_quantity' => 1,
        'day_of_week' => 'monday',
        'meal' => 'lunch',
    ]);

    $this->get('/')
        ->assertOk()
        ->assertSeeInOrder(['Verduras', 'Tomate']);
});

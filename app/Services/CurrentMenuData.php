<?php

namespace App\Services;

use App\Models\Menu;

class CurrentMenuData
{
    public static function currentMenu(): ?Menu
    {
        return Menu::query()
            ->with(['menuRecipes.recipe.recipeIngredients.ingredient.ingredientCategory'])
            ->latest()
            ->first();
    }

    /**
     * @return array<int, array{day: string, meal: string, recipes: string, quantity: int}>
     */
    public static function menuRows(?Menu $menu = null): array
    {
        $menu ??= self::currentMenu();

        if (! $menu) {
            return [];
        }

        $rows = [];

        foreach ($menu->menuRecipes()->orderedByDayAndMeal()->get() as $menuRecipe) {
            $day = $menuRecipe->day_of_week instanceof \BackedEnum ? $menuRecipe->day_of_week->value : $menuRecipe->day_of_week;
            $meal = $menuRecipe->meal instanceof \BackedEnum ? $menuRecipe->meal->value : $menuRecipe->meal;

            $rows[] = [
                'day' => $day,
                'meal' => $meal,
                'recipes' => $menuRecipe->recipe->name,
                'quantity' => $menuRecipe->recipe_quantity,
            ];
        }

        return $rows;
    }

    /**
     * @return array<int, array{category: string, ingredient: string, qty: string}>
     */
    public static function shoppingRows(?Menu $menu = null): array
    {
        $menu ??= self::currentMenu();

        if (! $menu) {
            return [];
        }

        $shopping = [];

        foreach ($menu->menuRecipes()->orderedByDayAndMeal()->get() as $menuRecipe) {
            foreach ($menuRecipe->recipe->recipeIngredients as $recipeIngredient) {
                $ingredient = $recipeIngredient->ingredient;
                $categoryName = $ingredient->ingredientCategory?->name ?? 'Sin categoría';
                $id = $ingredient->id;
                $needed = ($recipeIngredient->ingredient_quantity ?? 0) * ($menuRecipe->recipe_quantity ?? 1);

                if (! isset($shopping[$categoryName][$id])) {
                    $shopping[$categoryName][$id] = [
                        'ingredient' => $ingredient->name,
                        'qty' => 0,
                        'unit' => $ingredient->unit instanceof \BackedEnum ? $ingredient->unit->value : $ingredient->unit,
                    ];
                }

                $shopping[$categoryName][$id]['qty'] += $needed;
            }
        }

        $rows = [];

        foreach ($shopping as $categoryName => $ingredients) {
            foreach ($ingredients as $item) {
                $qty = round((float) $item['qty'], 2);
                $formattedQty = (float) $qty == (int) $qty ? (int) $qty : $qty;
                $unit = $item['unit'] ?? null;

                $rows[] = [
                    'category' => $categoryName,
                    'ingredient' => $item['ingredient'],
                    'qty' => $formattedQty.$unit,
                ];
            }
        }

        return $rows;
    }
}

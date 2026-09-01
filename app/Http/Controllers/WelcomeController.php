<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $menu = Menu::with(['menuRecipes.recipe.recipeIngredients.ingredient.ingredientCategory'])->latest()->first();

        $structured = [];
        $shopping = [];

        if ($menu) {
            $menuRecipes = $menu->menuRecipes()->orderedByDayAndMeal()->get();

            foreach ($menuRecipes as $mr) {
                $day = is_object($mr->day_of_week) && property_exists($mr->day_of_week, 'value') ? $mr->day_of_week->value : $mr->day_of_week;
                $meal = is_object($mr->meal) && property_exists($mr->meal, 'value') ? $mr->meal->value : $mr->meal;

                $structured[$day][$meal][] = [
                    'name' => $mr->recipe->name,
                    'qty' => $mr->recipe_quantity,
                ];

                foreach ($mr->recipe->recipeIngredients as $ri) {
                    $ing = $ri->ingredient;
                    $id = $ing->id;
                    $needed = ($ri->ingredient_quantity ?? 0) * ($mr->recipe_quantity ?? 1);

                    $unit = null;
                    if (is_object($ing->unit) && property_exists($ing->unit, 'value')) {
                        $unit = $ing->unit->value;
                    } else {
                        $unit = $ing->unit;
                    }

                    $categoryName = $ing->ingredientCategory?->name ?? 'Sin categoría';

                    if (! isset($shopping[$categoryName][$id])) {
                        $shopping[$categoryName][$id] = [
                            'ingredient' => $ing->name,
                            'qty' => 0,
                            'unit' => $unit,
                        ];
                    }

                    $shopping[$categoryName][$id]['qty'] += $needed;
                }
            }
        }

        // format shopping list grouped by category
        $shoppingList = [];
        foreach ($shopping as $categoryName => $ingredients) {
            $group = [];

            foreach ($ingredients as $it) {
                $qty = round($it['qty'], 2);
                $qty = (float) $qty == (int) $qty ? (int) $qty : $qty;
                $group[] = [
                    'ingredient' => $it['ingredient'],
                    'qty' => $qty.($it['unit'] ? $it['unit'] : ''),
                ];
            }

            $shoppingList[] = [
                'category' => $categoryName,
                'items' => $group,
            ];
        }

        return view('welcome', [
            'menu_name' => $menu?->name,
            'menu' => $structured,
            'shopping' => $shoppingList,
        ]);
    }
}

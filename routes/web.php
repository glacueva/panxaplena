<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index']);

// Export shopping list as plain text. Expects JSON { shopping: [ { ingredient, qty }, ... ] }
Route::post('/export/shopping', function (Request $request) {
    $shopping = $request->input('shopping', []);
    $date = now()->format('d-m-Y');
    $lines = [];
    $lines[] = "Shopping List ({$date})";
    $lines[] = "Qty\tIngredient";
    foreach ($shopping as $item) {
        $qty = isset($item['qty']) ? $item['qty'] : '';
        $ing = isset($item['ingredient']) ? $item['ingredient'] : '';
        $lines[] = "{$qty}\t{$ing}";
    }
    $text = implode("\n", $lines)."\n";

    return response($text, 200)->header('Content-Type', 'text/plain');
});

// Export menu as plain text. Expects JSON { menu_name: string, menu: { day: { mealName: [ { name, qty }, ... ] } } }
Route::post('/export/menu', function (Request $request) {
    $menu = $request->input('menu', []);
    $menuName = $request->input('menu_name', 'Menu');
    $lines = [];
    $lines[] = $menuName;
    foreach ($menu as $day => $meals) {
        $lines[] = "{$day}:";
        foreach ($meals as $mealName => $recipes) {
            $lines[] = "\t{$mealName}:";
            foreach ($recipes as $r) {
                $qty = isset($r['qty']) ? $r['qty'] : '';
                $name = isset($r['name']) ? $r['name'] : '';
                $lines[] = "\t\t{$qty}\t{$name}";
            }
        }
    }
    $text = implode("\n", $lines)."\n";

    return response($text, 200)->header('Content-Type', 'text/plain');
});

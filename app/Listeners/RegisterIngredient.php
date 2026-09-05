<?php

namespace App\Listeners;

use App\Events\IngredientCreated;
use App\Models\StockType;

class RegisterIngredient
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(IngredientCreated $event): void
    {
        //
        $ingredient = $event->ingredient;
        StockType::each(function ($stockType) use ($ingredient) {
            $ingredient->stocks()->create([
                'stock_type_id' => $stockType->id,
                'ingredient_quantity' => 0,
            ]);
        });
    }
}

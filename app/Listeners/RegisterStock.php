<?php

namespace App\Listeners;

use App\Events\StockCreated;
use App\Models\Ingredient;

class RegisterStock
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
    public function handle(StockCreated $event): void
    {
        //
        $stockType = $event->stockType;
        Ingredient::each(function ($ingredient) use ($stockType) {
            $ingredient->stocks()->create([
                'stock_type_id' => $stockType->id,
                'ingredient_quantity' => 0,
            ]);
        });

    }
}

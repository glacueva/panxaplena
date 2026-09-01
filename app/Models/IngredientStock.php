<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['ingredient_id', 'stock_type_id', 'ingredient_quantity'])]
class IngredientStock extends Model
{
    use HasFactory;

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function stockType()
    {
        return $this->belongsTo(StockType::class);
    }
}

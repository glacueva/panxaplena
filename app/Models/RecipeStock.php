<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['recipe_id', 'stock_type_id', 'recipe_quantity'])]
class RecipeStock extends Model
{
    use HasFactory;

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function stockType()
    {
        return $this->belongsTo(StockType::class);
    }
}

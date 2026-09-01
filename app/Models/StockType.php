<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'icon'])]
class StockType extends Model
{
    use HasFactory;

    public function recipeStocks()
    {
        return $this->hasMany(RecipeStock::class);
    }

    public function ingredientStocks()
    {
        return $this->hasMany(IngredientStock::class);
    }
}

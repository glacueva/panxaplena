<?php

namespace App\Models;

use App\Events\StockCreated;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'icon'])]
class StockType extends Model
{
    /**
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => StockCreated::class,
    ];

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

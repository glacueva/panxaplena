<?php

namespace App\Models;

use App\Enums\Unit;
use App\Events\IngredientCreated;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'unit', 'ingredient_category_id'])]
class Ingredient extends Model
{
    /**
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => IngredientCreated::class,
    ];

    use HasFactory;

    protected function casts(): array
    {
        return [
            'unit' => Unit::class,
        ];
    }

    public function stocks()
    {
        return $this->hasMany(IngredientStock::class);
    }

    public function recipeIngredients()
    {
        return $this->hasMany(RecipeIngredient::class);
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_ingredients')
            ->withPivot('ingredient_quantity')
            ->withTimestamps();
    }

    public function ingredientCategory()
    {
        return $this->belongsTo(IngredientCategory::class, 'ingredient_category_id');
    }
}

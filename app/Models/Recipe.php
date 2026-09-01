<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name'])]
class Recipe extends Model
{
    use HasFactory;

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients')
            ->withPivot('ingredient_quantity')
            ->withTimestamps();
    }

    public function recipeIngredients()
    {
        return $this->hasMany(RecipeIngredient::class);
    }

    public function recipeStocks()
    {
        return $this->hasMany(RecipeStock::class);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_recipes')
            ->withPivot(['recipe_quantity', 'day_of_week', 'meal'])
            ->withTimestamps();
    }
}

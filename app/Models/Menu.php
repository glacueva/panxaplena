<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name'])]
class Menu extends Model
{
    use HasFactory;

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'menu_recipes')
            ->withPivot(['recipe_quantity', 'day_of_week', 'meal'])
            ->withTimestamps();
    }

    public function menuRecipes()
    {
        return $this->hasMany(MenuRecipe::class);
    }
}

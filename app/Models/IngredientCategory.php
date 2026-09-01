<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name'])]
class IngredientCategory extends Model
{
    use HasFactory;

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class, 'ingredient_category_id');
    }
}

<?php

namespace App\Models;

use App\Enums\DayOfWeek;
use App\Enums\Meal;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['menu_id', 'recipe_id', 'recipe_quantity', 'day_of_week', 'meal'])]
class MenuRecipe extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'day_of_week' => DayOfWeek::class,
            'meal' => Meal::class,
        ];
    }

    public function scopeOrderedByDayAndMeal(Builder $query): Builder
    {
        $dayCase = 'CASE ';
        foreach (DayOfWeek::ordered() as $index => $day) {
            $dayCase .= "WHEN day_of_week = '{$day->value}' THEN {$index} ";
        }
        $dayCase .= 'END';

        $mealCase = 'CASE ';
        foreach (Meal::ordered() as $index => $meal) {
            $mealCase .= "WHEN meal = '{$meal->value}' THEN {$index} ";
        }
        $mealCase .= 'END';

        return $query->orderByRaw("{$dayCase} ASC, {$mealCase} ASC");
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}

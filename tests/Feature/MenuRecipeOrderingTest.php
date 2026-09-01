<?php

use App\Models\MenuRecipe;

it('orders menu recipes by weekday and meal', function () {
    $sql = MenuRecipe::query()->orderedByDayAndMeal()->toSql();

    expect($sql)
        ->toContain('CASE')
        ->toContain('day_of_week')
        ->toContain('meal')
        ->toContain("'monday'")
        ->toContain("'breakfast'");
});

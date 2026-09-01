<?php

namespace App\Filament\Resources\Ingredients\Schemas;

use App\Enums\Unit;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class IngredientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('unit')
                    ->options(Unit::class)
                    ->required(),
                Select::make('ingredient_category_id')
                    ->relationship('ingredientCategory', 'name'),
            ]);
    }
}

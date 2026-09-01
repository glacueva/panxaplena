<?php

namespace App\Filament\Resources\IngredientCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class IngredientCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
            ]);
    }
}

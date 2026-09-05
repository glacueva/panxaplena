<?php

namespace App\Filament\Resources\StockTypes\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;

class IngredientStocksRelationManager extends RelationManager
{
    protected static string $relationship = 'ingredientStocks';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('ingredient_id')
                    ->relationship('ingredient', 'name')
                    ->label('Ingredient')
                    ->required(),
                TextInput::make('ingredient_quantity')
                    ->required()
                    ->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name,ingredient_quantity')
            ->columns([
                TextColumn::make('ingredient.name')
                    ->sortable(),
                TextInputColumn::make('ingredient_quantity')
                    ->rules(['required', 'numeric'])
                    ->type('number')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
            ])
            ->recordActions([
            ])
            ->toolbarActions([
            ]);
    }
}

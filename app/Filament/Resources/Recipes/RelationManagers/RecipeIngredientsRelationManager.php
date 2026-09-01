<?php

namespace App\Filament\Resources\Recipes\RelationManagers;

use App\Enums\Unit;
use App\Models\Ingredient;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RecipeIngredientsRelationManager extends RelationManager
{
    protected static string $relationship = 'recipeIngredients';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('ingredient_id')
                    ->relationship('ingredient', 'name')
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->createOptionForm([
                        TextInput::make('name')->required(),
                        Select::make('unit')->options(Unit::class)->required(),
                        Select::make('ingredient_category_id')->relationship('ingredientCategory', 'name'),
                    ]),
                TextInput::make('ingredient_quantity')
                    ->required()
                    ->numeric()
                    ->suffix(fn (Get $get) => Ingredient::find($get('ingredient_id'))->unit->value ?? ''),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('ingredient.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('ingredient_quantity')
                    ->label('Quantity')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('ingredient.unit')
                    ->label('Unit')
                    ->badge()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

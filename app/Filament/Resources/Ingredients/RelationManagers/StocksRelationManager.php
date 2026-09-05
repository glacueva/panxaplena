<?php

namespace App\Filament\Resources\Ingredients\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;

class StocksRelationManager extends RelationManager
{
    protected static string $relationship = 'stocks';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('stock_type_id')
                    ->relationship('stockType', 'name')
                    ->label('Stock')
                    ->required(),
                TextInput::make('ingredient_quantity')
                    ->required()
                    ->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('stockType.name')
            ->columns([
                TextColumn::make('stockType.name')
                    ->label('Stock')
                    ->sortable()
                    ->searchable(),
                TextInputColumn::make('ingredient_quantity')
                    ->label('Cantidad')
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

<?php

namespace App\Filament\Widgets;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class CurrentShoppingListWidget extends TableWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category'),
                TextColumn::make('ingredient'),
                TextColumn::make('qty'),
            ])
            ->groups(['category'])
            ->defaultGroup('category')
            ->records(fn() => CurrentMenuData::shoppingRows());
    }
}

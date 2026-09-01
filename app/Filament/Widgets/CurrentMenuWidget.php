<?php

namespace App\Filament\Widgets;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class CurrentMenuWidget extends TableWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('day')
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                TextColumn::make('meal')
                    ->formatStateUsing(fn (string $state): string => ucfirst(str_replace('_', ' ', $state))),
                TextColumn::make('recipes'),
                TextColumn::make('quantity'),
            ])
            ->groups(['day','meal'])
            ->defaultGroup('day')
            ->records(fn() => CurrentMenuData::menuRows());
    }
}

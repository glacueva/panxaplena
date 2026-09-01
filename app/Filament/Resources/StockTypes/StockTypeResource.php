<?php

namespace App\Filament\Resources\StockTypes;

use App\Filament\Resources\StockTypes\Pages\CreateStockType;
use App\Filament\Resources\StockTypes\Pages\EditStockType;
use App\Filament\Resources\StockTypes\Pages\ListStockTypes;
use App\Filament\Resources\StockTypes\Schemas\StockTypeForm;
use App\Filament\Resources\StockTypes\Tables\StockTypesTable;
use App\Models\StockType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use UnitEnum;

class StockTypeResource extends Resource
{
    protected static ?string $model = StockType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static UnitEnum|string|null $navigationGroup = 'Settings';

    public static function form(Schema $schema): Schema
    {
        return StockTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StockTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStockTypes::route('/'),
            'create' => CreateStockType::route('/create'),
            'edit' => EditStockType::route('/{record}/edit'),
        ];
    }
}

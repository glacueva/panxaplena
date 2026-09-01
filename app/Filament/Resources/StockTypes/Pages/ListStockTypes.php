<?php

namespace App\Filament\Resources\StockTypes\Pages;

use App\Filament\Resources\StockTypes\StockTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStockTypes extends ListRecords
{
    protected static string $resource = StockTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

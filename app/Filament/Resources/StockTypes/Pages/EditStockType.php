<?php

namespace App\Filament\Resources\StockTypes\Pages;

use App\Filament\Resources\StockTypes\StockTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStockType extends EditRecord
{
    protected static string $resource = StockTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

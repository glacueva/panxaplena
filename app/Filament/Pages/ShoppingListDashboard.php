<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\CurrentShoppingListWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use UnitEnum;
use BackedEnum;
use Filament\Support\Icons\Heroicon;

class ShoppingListDashboard extends BaseDashboard
{
    protected static string $routePath = '/shopping-list';

    protected static ?string $navigationLabel = 'Shopping List';

    protected static ?string $title = 'Shopping List';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::ShoppingBag;
    protected static UnitEnum|string|null $navigationGroup = 'Dashboard';

    public function getWidgets(): array
    {
        return [CurrentShoppingListWidget::class];
    }
}

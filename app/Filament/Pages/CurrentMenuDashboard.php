<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\CurrentMenuWidget;
use BackedEnum;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class CurrentMenuDashboard extends BaseDashboard
{
    protected static string $routePath = '/';

    protected static ?string $navigationLabel = 'Current Menu';

    protected static ?string $title = null;

    protected static BackedEnum|string|null $navigationIcon = Heroicon::Calendar;

    protected static UnitEnum|string|null $navigationGroup = 'Dashboard';

    public function getWidgets(): array
    {
        return [CurrentMenuWidget::class];
    }
}

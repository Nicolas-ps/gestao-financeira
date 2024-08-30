<?php

namespace App\Filament\Pages;

use App\Filament\Admin\Widgets\DebtOverview;
use App\Filament\Admin\Widgets\IncomesOverview;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;

class Dashboard extends BaseDashboard
{
    protected static string $routePath = '/';
    protected static ?string $title = 'Página Inicial';

    public function getHeaderWidgets(): array
    {
        return [
            AccountWidget::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int|array|string
    {
        return 1;
    }

    public function getWidgets(): array
    {
        return [
            DebtOverview::class,
        ];
    }

}
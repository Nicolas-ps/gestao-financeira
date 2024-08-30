<?php

namespace App\Filament\Admin\Widgets;

use App\Enum\DebtStatusEnum;
use App\Models\Debt;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PendingDebtsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $value = Debt::where('status_id', DebtStatusEnum::Pendente->value)->sum('value');
        $value = number_format($value, 2, ',', '.');

        return [
            Stat::make('Dívidas pendentes', "R$ {$value}")
                ->description('As sua dívidas ainda não vencidas somam isso')
                ->descriptionIcon('heroicon-m-arrow-trending-down', IconPosition::Before)
                ->color('warning')
                ->extraAttributes([
                    'x-bind:aria-label' => 'Dívidas pendentes',
                    'class' => 'cursor-pointer',
                ]),
        ];
    }
}

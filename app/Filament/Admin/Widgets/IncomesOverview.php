<?php

namespace App\Filament\Admin\Widgets;

use App\Enum\DebtStatusEnum;
use App\Models\Debt;
use App\Models\Income;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class IncomesOverview extends BaseWidget
{

    public function getColumns(): int
    {
        return 2;
    }
    protected function getStats(): array
    {
        $value = Income::all()->sum('value');
        $value = number_format($value, 2, ',', '.');

        return [
            Stat::make('Entradas totais do mês', "R$ {$value}")
                ->description('Todos os seus ganhos do mês somam isso!')
                ->descriptionIcon('heroicon-m-arrow-trending-up', IconPosition::Before)
                ->color('primary')
                ->extraAttributes([
                    'x-bind:aria-label' => 'Entradas totais',
                    'class' => 'cursor-pointer',
                ]),
        ];
    }
}

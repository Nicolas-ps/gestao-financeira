<?php

namespace App\Filament\Admin\Widgets;

use App\Enum\DebtStatusEnum;
use App\Models\Debt;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LateDebtsOverviews extends BaseWidget
{
    protected function getStats(): array
    {
        $value = Debt::where('status_id', DebtStatusEnum::Atrasado->value)->sum('value');
        $value = number_format($value, 2, ',', '.');

        return [
            Stat::make('Dívidas atrasadas', "R$ {$value}")
                ->description('As sua dívidas que já venceram somam isso!')
                ->descriptionIcon('heroicon-m-arrow-trending-down', IconPosition::Before)
                ->color('warning')
                ->extraAttributes([
                    'x-bind:aria-label' => 'Dívidas atrasadas',
                    'class' => 'cursor-pointer',
                ]),
        ];
    }
}

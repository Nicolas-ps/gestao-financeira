<?php

namespace App\Filament\Admin\Widgets;

use App\Enum\DebtStatusEnum;
use App\Models\Debt;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DebtOverview extends BaseWidget
{
    protected function getColumns(): int
    {
        return 3;
    }

    protected function getStats(): array
    {
        $value = Debt::whereIn(
            'status_id', [DebtStatusEnum::Pendente->value, DebtStatusEnum::Atrasado->value]
        )->sum('value');
        $value = number_format($value, 2, ',', '.');

        return [
            Stat::make('Dívidas em aberto', "R$ {$value}")
                ->description('As sua dívidas em aberto somam isso')
                ->descriptionIcon('heroicon-m-arrow-trending-down', IconPosition::Before)
                ->color('danger')
                ->extraAttributes([
                    'x-bind:aria-label' => 'Dívidas pendentes',
                    'class' => 'cursor-pointer',
                ]),
            $this->getLateDebts(),
            $this->getPendingDebts()
        ];
    }

    public function getLateDebts(): Stat
    {
        $value = Debt::where('status_id', DebtStatusEnum::Atrasado->value)->sum('value');
        $value = number_format($value, 2, ',', '.');

        return Stat::make('Dívidas atrasadas', "R$ {$value}")->description(
                'As sua dívidas que já venceram somam isso!'
            )->descriptionIcon(
                'heroicon-m-arrow-trending-down',
                IconPosition::Before
            )->color('warning')->extraAttributes([
                'x-bind:aria-label' => 'Dívidas atrasadas',
                'class'             => 'cursor-pointer',
            ]);
    }

    public function getPendingDebts(): Stat
    {
        $value = Debt::where('status_id', DebtStatusEnum::Pendente->value)->sum('value');
        $value = number_format($value, 2, ',', '.');

        return Stat::make('Dívidas pendentes', "R$ {$value}")
                ->description('As sua dívidas ainda não vencidas somam isso')
                ->descriptionIcon('heroicon-m-arrow-trending-down', IconPosition::Before)
                ->color('warning')
                ->extraAttributes([
                    'x-bind:aria-label' => 'Dívidas pendentes',
                    'class' => 'cursor-pointer',
                ]);
    }
}

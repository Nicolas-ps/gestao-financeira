<?php

namespace App\Filament\Admin\Resources\DebtResource\Pages;

use App\Enum\DebtStatusEnum;
use App\Filament\Admin\Resources\DebtResource;
use App\Filament\Admin\Widgets\DebtOverview;
use App\Filament\Admin\Widgets\LateDebtsOverviews;
use App\Filament\Admin\Widgets\PendingDebtsOverview;
use App\Models\Debt;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListDebts extends ListRecords
{
    protected static string $resource = DebtResource::class;
    protected static ?string $breadcrumb = 'Todas as dívidas';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Adicionar Dívida'),
        ];
    }

    public function getHeaderWidgetsColumns(): int
    {
        return 3;
    }

    public function getHeaderWidgets(): array
    {
        return [
            DebtOverview::class
        ];
    }
}

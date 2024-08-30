<?php

namespace App\Filament\Admin\Resources\IncomeResource\Pages;

use App\Filament\Admin\Resources\IncomeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIncomes extends ListRecords
{
    protected static string $resource = IncomeResource::class;
    protected static ?string $breadcrumb = 'Listagem';
    protected static ?string $title = 'Todas as entradas';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Adicionar Entrada')
                ->modalCancelActionLabel('Cancelar')
        ];
    }
}

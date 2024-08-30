<?php

namespace App\Filament\Admin\Resources\IncomeResource\Pages;

use App\Filament\Admin\Resources\IncomeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIncome extends EditRecord
{
    protected static string $resource = IncomeResource::class;
    protected static ?string $breadcrumb = 'Atualizar';
    protected static ?string $title = 'Atualizar entrada';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Deletar')
                ->modalHeading('Deletar entrada')
                ->modalDescription('O valor da entrada será subtraído do seu orçamento mensal. Deseja continuar?')
                ->modalCancelActionLabel('Cancelar')
                ->modalSubmitActionLabel('Deletar')
        ];
    }
}

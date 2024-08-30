<?php

namespace App\Filament\Admin\Resources\DebtResource\Pages;

use App\Filament\Admin\Resources\DebtResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDebt extends EditRecord
{
    protected static string $resource = DebtResource::class;
    protected static ?string $breadcrumb = 'Atualizar';
    protected static ?string $title = 'Atualizar dívida';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Deletar')
        ];
    }
}

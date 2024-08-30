<?php

namespace App\Filament\Admin\Resources\IncomeResource\Pages;

use App\Filament\Admin\Resources\IncomeResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateIncome extends CreateRecord
{
    protected static string $resource = IncomeResource::class;
    protected static ?string $breadcrumb = 'Adicionar';
    protected static ?string $title = 'Adicionar entrada';

    public function getCreatedNotification(): Notification
    {
        return Notification::make()
            ->success()
            ->title('Nova entrada adicionada');
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label('Adicionar'),
            $this->getCreateAnotherFormAction()->label('Adicionar e criar outra'),
            $this->getCancelFormAction()->label('Cancelar'),
        ];
    }
}

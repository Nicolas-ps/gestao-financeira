<?php

namespace App\Filament\Admin\Resources\DebtResource\Pages;

use App\Filament\Admin\Resources\DebtResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDebt extends CreateRecord
{
    protected static string $resource = DebtResource::class;
    protected static ?string $title = 'Adicionar Dívida';
    protected static ?string $breadcrumb = 'Adicionar';


}

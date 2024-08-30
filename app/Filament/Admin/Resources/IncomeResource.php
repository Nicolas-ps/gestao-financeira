<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\IncomeResource\Pages;
use App\Filament\Admin\Resources\IncomeResource\RelationManagers;
use App\Models\Income;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IncomeResource extends Resource
{
    protected static ?string $model = Income::class;
    protected static ?string $breadcrumb = 'Entradas';
    protected static ?string $label = 'Entradas';
    protected static ?string $navigationGroup = 'Controle';


    public static function form(Form $form): Form
    {
        $inputMask =<<<'JS'
$money($input, '.', ',', 2)
JS;

        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->label('Descrição')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->label('Data')
                    ->required(),
                Forms\Components\TextInput::make('value')
                    ->label('Valor')
                    ->numeric()
                    ->mask(RawJs::make($inputMask))
                    ->stripCharacters(['.', ','])
                    ->suffixIcon('heroicon-s-currency-dollar')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição'),
                Tables\Columns\TextColumn::make('value')
                    ->badge()
                    ->color('primary')
                    ->numeric()
                    ->money('BRL')
                    ->label('Valor'),
                Tables\Columns\TextColumn::make('date')
                    ->date('d/m/Y')
                    ->label('Data')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Editar')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('User registered')
                            ->body('The user has been created successfully.'),
                    )
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIncomes::route('/'),
            'create' => Pages\CreateIncome::route('/create'),
            'edit' => Pages\EditIncome::route('/{record}/edit'),
        ];
    }
}

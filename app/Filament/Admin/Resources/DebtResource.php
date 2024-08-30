<?php

namespace App\Filament\Admin\Resources;

use App\Enum\DebtStatusEnum;
use App\Filament\Admin\Resources\DebtResource\Pages;
use App\Filament\Admin\Resources\DebtResource\RelationManagers;
use App\Models\PaymentMethod;
use App\Models\Category;
use App\Models\Debt;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;

class DebtResource extends Resource
{
    protected static ?string $model = Debt::class;

    protected static ?string $label = 'Dívidas';

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
                Forms\Components\Select::make('category_id')
                    ->options(Category::all()->pluck('name', 'id'))
                    ->searchable()
                    ->preload()
                    ->label('Categoria')
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->label('Data de realização')
                    ->required(),
                Forms\Components\DatePicker::make('due_date')
                    ->label('Data de vencimento')
                    ->required(),
                Forms\Components\TextInput::make('value')
                    ->label('Valor')
                    ->numeric()
                    ->mask(RawJs::make($inputMask))
                    ->stripCharacters(',')
                    ->suffixIcon('heroicon-s-currency-dollar')
                    ->required(),
                Forms\Components\Select::make('status_id')
                    ->relationship('status', 'title')
                    ->label('Status da dívida')
                    ->required(),
                Forms\Components\Select::make('payment_method_id')
                    ->relationship('paymentMethod', 'name')
                    ->label('Forma de pagamento')
                    ->required(),
                Forms\Components\Checkbox::make('installment')
                    ->label('É uma parcela?')
                    ->reactive()
                    ->requiredWith('installment_number')
                    ->afterStateUpdated(
                        fn ($state, callable $set) => $state ? $set('installment_number', null) : $set('installment_number', 'hidden')
                    ),
                Forms\Components\TextInput::make('installment_number')
                    ->requiredWith('installment')
                    ->numeric()
                    ->hidden(
                        fn ($get): bool => $get('installment') == false
                    ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->badge()
                    ->label('Categoria'),
                Tables\Columns\TextColumn::make('due_date')
                    ->date('d/m/Y')
                    ->label('Data de vencimento')
                    ->sortable(),
                Tables\Columns\TextColumn::make('value')
                    ->numeric()
                    ->money('BRL')
                    ->label('Valor'),
                Tables\Columns\IconColumn::make('status_id')
                    ->label('Status')
                    ->icon(fn (int $state): string => match ($state) {
                            DebtStatusEnum::Pendente->value => 'heroicon-o-clock',
                            DebtStatusEnum::Pago->value => 'heroicon-o-check-circle',
                            DebtStatusEnum::Atrasado->value => 'heroicon-o-x-mark',
                            default => 'heroicon-s-question-mark-circle',
                        }
                    )->color(fn(int $state): string => match ($state) {
                            DebtStatusEnum::Pendente->value => 'warning',
                            DebtStatusEnum::Pago->value => 'success',
                            DebtStatusEnum::Atrasado->value => 'danger',
                        }
                    )->label('Status'),
                Tables\Columns\SelectColumn::make('payment_method_id')
                    ->selectablePlaceholder(false)
                    ->label('Forma de pagamento')
                    ->options(PaymentMethod::all()->pluck('name', 'id')->toArray())
                    ->rules(['required']),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category.name')
                    ->label('Categoria')
                    ->relationship('category', 'name')
                    ->preload()
                    ->multiple(),
                Tables\Filters\SelectFilter::make('status.title')
                    ->label('Status')
                    ->relationship('status', 'title'),
                Tables\Filters\SelectFilter::make('paymentMethod.name')
                    ->label('Forma de pagamento')
                    ->relationship('paymentMethod', 'name')
                    ->preload()
                    ->multiple()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListDebts::route('/'),
            'create' => Pages\CreateDebt::route('/create'),
            'edit' => Pages\EditDebt::route('/{record}/edit'),
        ];
    }
}

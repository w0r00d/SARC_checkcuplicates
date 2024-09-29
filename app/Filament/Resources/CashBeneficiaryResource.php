<?php

namespace App\Filament\Resources;

use App\Filament\Imports\CashBeneficiaryImporter;
use App\Filament\Resources\CashBeneficiaryResource\Pages;
use App\Models\CashBeneficiary;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Table;

class CashBeneficiaryResource extends Resource
{
    protected static ?string $model = CashBeneficiary::class;

    protected static ?string $navigationIcon = 'heroicon-s-banknotes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('national_id')
                    ->required()
                    ->maxLength(11),
                Forms\Components\TextInput::make('fullname')
                    ->required()
                    ->maxLength(11),
                Forms\Components\Select::make('governate')
                    ->options([
                        'Damascus' => 'Damascus',
                        'Aleppo' => 'Aleppo',
                        'Homs' => 'Homs',
                        'Hama' => 'Hama',
                        'Latakia' => 'Latakia',
                        'Tartous' => 'Tartous',
                        'As-Sweida' => 'As-Sweida',
                        'Ar-Raqqa' => 'Ar-Raqqa',
                        'Daraa' => 'Daraa',
                        'Idleb' => 'Idleb',
                        'Quneitra' => 'Quneitra',
                        'Rurla Damascus' => 'Rural Damascus',
                        'Der-ez-zor' => 'Der-ez-zor',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('value')
                    ->required(),
                Forms\Components\TextInput::make('value')
                    ->required(),
                Forms\Components\DatePicker::make('transfer_date')
                    ->required(),
                Forms\Components\TextInput::make('project')
                    ->required(),
                Forms\Components\TextInput::make('donor')
                    ->required(),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Beneficaries')
            ->description('Cash Distribution')
            ->headerActions([
                ImportAction::make()
                    ->importer(CashBeneficiaryImporter::class)
                    ->label('Import Data'),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('national_id')->searchable(),
                Tables\Columns\TextColumn::make('fullname')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('governate')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('value')
                    ->numeric()
                    ->suffix(' SP')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('transfer_date')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('project')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('donor')
                    ->searchable()
                    ->sortable()
                    ->badge(),

            ])
            ->groups(['national_id',
                'donor',
            ])
            ->filters([
                //
                Tables\Filters\SelectFilter::make('donor')
                    ->options([
                        'GRC' => 'GRC',
                        'DRC' => 'DRC',
                        'ICRC' => 'ICRC',
                        'SRC' => 'SRC',
                    ]),
                Tables\Filters\SelectFilter::make('governate')
                    ->multiple()
                    ->options(['Damascus' => 'Damascus',
                        'Aleppo' => 'Aleppo',
                        'Homs' => 'Homs',
                        'Hama' => 'Hama',
                        'Latakia' => 'Latakia',
                        'Tartous' => 'Tartous',
                        'As-Sweida' => 'As-Sweida',
                        'Ar-Raqqa' => 'Ar-Raqqa',
                        'Daraa' => 'Daraa',
                        'Idleb' => 'Idleb',
                        'Quneitra' => 'Quneitra',
                        'Rurla Damascus' => 'Rural Damascus',
                        'Der-ez-zor' => 'Der-ez-zor', ]),
                Tables\Filters\SelectFilter::make('transfer_date')
                    ->form([
                        Forms\Components\DatePicker::make('transfer_date'),

                    ]),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->product)
            ->schema([
                // ...
                Infolists\Components\TextEntry::make('national_id')
                    ->label('National Id'),
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
            'index' => Pages\ListCashBeneficiaries::route('/'),
            'create' => Pages\CreateCashBeneficiary::route('/create'),
            'edit' => Pages\EditCashBeneficiary::route('/{record}/edit'),
        ];
    }
}

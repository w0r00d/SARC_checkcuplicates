<?php

namespace App\Filament\Resources;

use App\Filament\Imports\PendingBeneficiaryImporter;
use App\Filament\Resources\PendingBeneficiaryResource\Pages;
use App\Models\PendingBeneficiary;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Table;

class PendingBeneficiaryResource extends Resource
{
    protected static ?string $model = PendingBeneficiary::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

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
                    ->importer(PendingBeneficiaryImporter::class)
                    ->label('Import Data')
                    ->icon('heroicon-m-document')
                    ->disabled(! auth()->user()->isAdmin())
                    ->badge()
                    ->color('info')
                    ->size(ActionSize::Large)
                    ->outlined()
                    ->extraAttributes([
                        'style' => 'padding: 15px; font-size: 15px;',

                    ]),
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
            ->filters([
                //
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
            'index' => Pages\ListPendingBeneficiaries::route('/'),
            'create' => Pages\CreatePendingBeneficiary::route('/create'),
            'edit' => Pages\EditPendingBeneficiary::route('/{record}/edit'),
        ];
    }
}

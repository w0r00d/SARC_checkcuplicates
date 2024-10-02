<?php

namespace App\Filament\Resources;

use App\Filament\Imports\BeneficiaryImporter;
use App\Filament\Resources\BeneficiaryResource\Pages;
use App\Models\Beneficiary;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Table;

class BeneficiaryResource extends Resource
{
    protected static ?string $model = Beneficiary::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    // protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('national_id')
                    ->required()
                    ->maxLength(11),
                Forms\Components\TextInput::make('firstname')
                    ->required(),
                Forms\Components\TextInput::make('lastname')
                    ->required(),
                Forms\Components\Select::make('project_id')
                    ->relationship('projects', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ImportAction::make()
                    ->importer(BeneficiaryImporter::class),
            ])
            ->columns([
                //
                Tables\Columns\TextColumn::make('firstname'),
                Tables\Columns\TextColumn::make('lastname'),

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
            'index' => Pages\ListBeneficiaries::route('/'),
            'create' => Pages\CreateBeneficiary::route('/create'),
            'edit' => Pages\EditBeneficiary::route('/{record}/edit'),
        ];
    }
}

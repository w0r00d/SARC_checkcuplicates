<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CashBeneficiaryResource\Pages;
use App\Filament\Resources\CashBeneficiaryResource\RelationManagers;
use App\Models\CashBeneficiary;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\ImportAction;
use App\Filament\Imports\CashBeneficiaryImporter;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;


class CashBeneficiaryResource extends Resource
{
    protected static ?string $model = CashBeneficiary::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                        'Homs'=> 'Homs',
                        'Hama' => 'Hama',
                        'Latakia' => 'Latakia',
                        'Tartous' => 'Tartous',
                        'As-Sweida'=>'As-Sweida',
                        'Ar-Raqqa' =>'Ar-Raqqa',
                        'Daraa' =>'Daraa',
                        'Idleb'=> 'Idleb',
                        'Quneitra' =>'Quneitra',
                        'Rurla Damascus'=>'Rural Damascus',
                        'Der-ez-zor'=> 'Der-ez-zor'
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
        ->headerActions([ 
            ImportAction::make()
                ->importer(CashBeneficiaryImporter::class)
                ->label('Import Data'),
        ])
            ->columns([
                Tables\Columns\TextColumn::make('national_id'),
                Tables\Columns\TextColumn::make('fullname'),
                Tables\Columns\TextColumn::make('governate'),
                Tables\Columns\TextColumn::make('value'),
                Tables\Columns\TextColumn::make('transfer_date'),
                Tables\Columns\TextColumn::make('project'),
                Tables\Columns\TextColumn::make('donor'),
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

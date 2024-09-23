<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Filament\Imports\ProjectImporter;
use Filament\Tables\Actions\ImportAction;
class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static bool $shouldRegisterNavigation = false;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required(),
                Forms\Components\TextInput::make('donor')
                ->required(),
                Forms\Components\DatePicker::make('implementation_date')
                ->required()
                ->maxDate(now()),
                Forms\Components\Select::make('status')
                ->options([
                    'Planning' => 'planning',
                    'pending' => 'pending',
                    'on going' =>'on going',
                    'finished' => 'finished',
                    'stopped' => 'stopped'

                ])
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->headerActions([ 
            ImportAction::make()
        ->importer(ProjectImporter::class),
            
        ])
        
            ->columns([
                //
               
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('donor'),
                Tables\Columns\TextColumn::make('implementation_date'),

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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}

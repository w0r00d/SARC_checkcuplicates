<?php

namespace App\Livewire;

use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\BeneficiaryView;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class Deduplicate extends Component implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    public string $message = '';

    public ?Table $tab;

    public function render()
    {
        return view('livewire.deduplicate');
    }

    public function viewAll()
    {

        $this->message = 'hi';
        Table $t
            ->query(
                BeneficiaryView::query()->where('donor', 'GRC')
                    ->where('governate', 'Damascus')
            )
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

            ]);

    }

    public function table(Table $table): Table
    {
        if (auth()->user()->isAdmin()) {
            return $table
                ->query(
                    BeneficiaryView::query()->where('donor', 'GRC')
                        ->where('governate', 'Damascus')
                )
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

                ]);
        }
        if (auth()->user()->isOfficer()) {
            return $table
                ->query(
                    BeneficiaryView::query()->where('governate', 'homs')->where('donor', 'grc')
                )
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

                ]);
        }

        return $table
            ->query(

            )
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

            ]);

    }
}

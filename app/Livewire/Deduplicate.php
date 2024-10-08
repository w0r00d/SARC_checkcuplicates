<?php

namespace App\Livewire;

use App\Models\CashBeneficiary;
use App\Models\PendingBeneficiary;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class Deduplicate extends Component implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    public function render()
    {
        return view('livewire.deduplicate');
    }

    public function table(Table $table): Table
    {
        $b = CashBeneficiary::query();

        return $table
            ->query(
                PendingBeneficiary::query()->unionAll(CashBeneficiary::query())
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

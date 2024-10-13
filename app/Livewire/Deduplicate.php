<?php

namespace App\Livewire;

use App\Models\BeneficiaryView;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Deduplicate extends Component implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    public string $message = '';

    public $data;

    public $data2;

    public function render()
    {
        return view('livewire.deduplicate');
    }

    public function getData() {}

    public function getData2()
    {
        $this->data2 = DB::table('cash_beneficiaries')
            ->join('pending_beneficiaries', 'cash_beneficiaries.national_id', '=', 'pending_beneficiaries.national_id')
            ->select('pending_beneficiaries.national_id', DB::raw('count(pending_beneficiaries.national_id) as p_count'))
            ->groupby('pending_beneficiaries.national_id')
            ->get();

    }

    public function viewAll()
    {

        $this->message = 'hi';

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

                ])
                ->striped();
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

                ])
                ->striped();
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

            ])
            ->striped();

    }
}

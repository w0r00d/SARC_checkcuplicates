<?php

namespace App\Livewire;

use App\Models\PendingBeneficiary;
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

    public function render()
    {
        return view('livewire.deduplicate');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                PendingBeneficiary::query()->where('governate', 'homs')
                /*
                                PendingBeneficiary::select(['pending_beneficiaries.*', DB::raw('COUNT(p.national_id) as nid_count')])
                                    ->leftJoin('pending_beneficiaries as pb', 'pb.national_id', '=', 'pending_beneficiaries.national_id')
                                    ->groupBy('pending_beneficiaries.national_id')
                */
            )
            ->columns([
                Tables\Columns\TextColumn::make('national_id')->searchable(),
                Tables\Columns\TextColumn::make('count')->searchable(),
                /*
                Tables\Columns\TextColumn::make('fullname')
            ->searchable()
            ->sortable(),*/
                Tables\Columns\TextColumn::make('governate')
                    ->searchable()
                    ->sortable(),

            ]);
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;

use Filament\forms\Concerns\InteractsWithForms;
use Filament\forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\CashBeneficiary; 

class Duplicates extends Component implements HasTable, HasForms
{

    use interactsWithTable, interactsWithForms;

    public $message ;
    public $data;
    public function render()
    {
        return view('livewire.duplicates');
    }

    public function check(){
        $this->message = 'hello';
     // $this->data = CashBeneficiary::select('national_id')->groupBy('national_id')->get();
       $this->data = DB::table('cash_beneficiaries as cb')
      ->select('cb.national_id')
      ->groupBy('cb.national_id')
      ->get();

    }
    public function table (Table $table)  :Table {

        return  $table
        ->query(CashBeneficiary::query())
        ->columns([
            Tables\Columns\TextColumn::make('national_id'),
            Tables\Columns\TextColumn::make('fullname'),
            Tables\Columns\TextColumn::make('governate'),
            Tables\Columns\TextColumn::make('value'),
            Tables\Columns\TextColumn::make('transfer_date'),
            Tables\Columns\TextColumn::make('project'),
            Tables\Columns\TextColumn::make('donor'),
        ])
        ->groups(['national_id','project']);
    }
}

<?php

namespace App\Livewire;

use App\Models\BeneficiaryView;
use App\Models\PendingBeneficiary;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class Deduplicate extends Component implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;
    use WithFileUploads;

    public string $message = '';

    public $data;

    public $csv_file;

    public $csv_data = [];

    public $csv_headers = [];

    public $data2;

    public function render()
    {
        return view('livewire.deduplicate');
    }

    public function importCSV()
    {

        // Validate the file input
        $this->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048', // Ensure it's a CSV file
        ]);

        // Read the file
        $path = $this->csv_file->getRealPath();
        $file = fopen($path, 'r');
        $this->headers = fgetcsv($file); // Get the CSV header row

        // Empty the previous data
        $this->csv_data = [];

        // Loop through the CSV rows and store them
        while ($row = fgetcsv($file)) {
            $this->csv_data[] = array_combine($this->headers, $row); // Combine headers with row data
        }

        // Optionally, validate the data before saving
        /*
        Validator::make($data, [
            'name' => 'required|string', // Example validation, modify as needed
            'email' => 'required|email', // Example validation, modify as needed
        ])->validate();

        // Create or update your Eloquent model
        PendingBeneficiary::create([
            'national_id' => $data['national_id'],
            'fullname' => $data['fullname'],
            'governate' => $data['governate'],
            'value' => $data['value'],
            'transfer_date' => $data['transfer_date'],
            'project' => $data['project'],
            'donor' => $data['donor'],
        ]);
        }
*/
        // Close the file
        fclose($file);

        // Optionally, add a success message
        session()->flash('message', 'CSV data imported successfully!');
    }

    public function getData2()
    {
        $this->data2 = DB::table('beneficiaries_view')
            ->select('beneficiaries_view.national_id', 'beneficiaries_view.fullname', DB::Raw('count(beneficiaries_view.national_id) as p_count'))
            ->groupBy('beneficiaries_view.national_id', 'fullname')
            ->get();

        /*
                $this->data2 = DB::table('cash_beneficiaries')
                    ->join('pending_beneficiaries', 'cash_beneficiaries.national_id', '=', 'pending_beneficiaries.national_id')
                    ->select('pending_beneficiaries.national_id', DB::raw('count(cash_beneficiaries.national_id) as p_count'))
                    ->groupby('pending_beneficiaries.national_id')
                    ->get();
        */
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

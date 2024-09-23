<?php

namespace App\Filament\Imports;

use App\Models\CashBeneficiary;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class CashBeneficiaryImporter extends Importer
{
    protected static ?string $model = CashBeneficiary::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('national_id')
                ->requiredMapping()
                ->rules(['required', 'max:11']),
                ImportColumn::make('fullname')
                ->requiredMapping()
                ->rules(['required']),
                ImportColumn::make('governate')
                ->requiredMapping()
                ->rules(['required']),
                ImportColumn::make('value')
                ->requiredMapping()
                ->rules(['required']),
                ImportColumn::make('transfer_date')
                ->requiredMapping()
                ->rules(['required']),
                ImportColumn::make('project')
                ->requiredMapping()
                ->rules(['required']),
                ImportColumn::make('donor')
                ->requiredMapping()
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): ?CashBeneficiary
    {
        // return CashBeneficiary::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new CashBeneficiary();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your cash beneficiary import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}

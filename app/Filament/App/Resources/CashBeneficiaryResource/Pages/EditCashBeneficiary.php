<?php

namespace App\Filament\App\Resources\CashBeneficiaryResource\Pages;

use App\Filament\App\Resources\CashBeneficiaryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCashBeneficiary extends EditRecord
{
    protected static string $resource = CashBeneficiaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

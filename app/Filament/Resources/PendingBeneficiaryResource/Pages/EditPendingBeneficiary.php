<?php

namespace App\Filament\Resources\PendingBeneficiaryResource\Pages;

use App\Filament\Resources\PendingBeneficiaryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPendingBeneficiary extends EditRecord
{
    protected static string $resource = PendingBeneficiaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

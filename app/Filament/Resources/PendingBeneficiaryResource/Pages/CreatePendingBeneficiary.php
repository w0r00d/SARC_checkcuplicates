<?php

namespace App\Filament\Resources\PendingBeneficiaryResource\Pages;

use App\Filament\Resources\PendingBeneficiaryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePendingBeneficiary extends CreateRecord
{
    protected static string $resource = PendingBeneficiaryResource::class;
}

<?php

namespace App\Filament\Widgets;

use App\Models\CashBeneficiary;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BeneficiaryWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Beneficiaries', CashBeneficiary::count())
                ->description('Total Beneficiaries')
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->chart([5, 10, 15, 10, 25, 30])
                ->color('success'),
        ];
    }
}

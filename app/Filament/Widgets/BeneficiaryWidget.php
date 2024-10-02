<?php

namespace App\Filament\Widgets;

use App\Models\CashBeneficiary;
use App\Models\Project;
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
            Stat::make('Projects', Project::count())
                ->description('Total Projects')
                ->descriptionIcon('heroicon-m-presentation-chart-line', IconPosition::Before)
                ->chart([55, 10, 20, 10, 30, 30])
                ->color('info'),
        ];
    }
}

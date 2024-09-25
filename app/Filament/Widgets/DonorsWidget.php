<?php

namespace App\Filament\Widgets;

use App\Models\CashBeneficiary;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class DonorsWidget extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        /*
                $data = Trend::model(CashBeneficiary::class)
                    ->between(
                        start: now()->startOfYear(),
                        end: now()->endOfYear(),
                    )
                    ->perMonth()
                    ->count('donor');

                return [
                    'datasets' => [
                        [
                            'label' => 'Blog posts created',
                            'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                            'backgroundColor' => [
                                'rgb(255, 99, 132)',
                                'rgb(54, 162, 235)',
                                'rgb(255, 205, 86)',
                                'rgb(255, 85, 86)',
                                'rgb(54, 0, 235)',
                                'rgb(0, 0, 0)',
                            ],
                        ],
                    ],
                    'labels' => ['Jan', 'Feb', 'Mar', 'Apr'],
                ];
          */
        return [];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}

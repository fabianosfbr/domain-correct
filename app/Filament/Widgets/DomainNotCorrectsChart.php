<?php

namespace App\Filament\Widgets;

use App\Enums\UserRole;
use App\Models\DomainNotCorrect;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class DomainNotCorrectsChart extends ChartWidget
{
    protected static ?int $sort = 1;

    protected static ?string $heading = 'Dominios Incorretos';

    protected static ?string $description = 'Quantidade de dominios incorretos cadastrados por mês.';

    public static function canView(): bool
    {
        // @phpstan-ignore-next-line
        return auth()->user()->role === UserRole::ADMIN;
    }

    protected function getData(): array
    {
        $data = Trend::model(DomainNotCorrect::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Dominios Incorretos',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'cubicInterpolationMode' => 'monotone',
                    'tension' => 0.4,
                ],
            ],
            'labels' => ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

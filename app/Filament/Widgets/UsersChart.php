<?php

namespace App\Filament\Widgets;

use App\Enums\UserRole;
use App\Models\User;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class UsersChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected static ?string $heading = 'Novos Usuários';

    protected static ?string $description = 'Quantidade de novos usuários cadastrados por mês.';

    public static function canView(): bool
    {
        // @phpstan-ignore-next-line
        return auth()->user()->role === UserRole::ADMIN;
    }

    protected function getData(): array
    {
        $data = Trend::model(User::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Novos Usuários',
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

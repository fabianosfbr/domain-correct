<?php

namespace App\Filament\Widgets;

use App\Enums\UserRole;
use App\Models\DomainCorrect;
use App\Models\DomainNotCorrect;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    public static function canView(): bool
    {
        // @phpstan-ignore-next-line
        return auth()->user()->role === UserRole::ADMIN;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Dominios Corretos', DomainCorrect::count())
                ->descriptionIcon('heroicon-m-check-badge')
                ->descriptionColor('success')
                ->description('Quantidade de dominios que estão corretos')
                ->color('success'),
            Stat::make('Dominios Não Corretos', DomainNotCorrect::count())
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->descriptionColor('warning')
                ->description('Quantidade de dominios vinculados a um correto')
                ->color('warning'),
            Stat::make('Clientes', User::where('role', '=', UserRole::CLIENT)->count())
                ->descriptionIcon('heroicon-o-user')
                ->descriptionColor('primary')
                ->description('Quantidade de clientes cadastrados')
                ->color('primary'),
        ];
    }
}

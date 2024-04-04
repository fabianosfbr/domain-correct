<?php

namespace App\Filament\Widgets;

use App\Enums\UserRole;
use App\Models\DomainNotCorrect;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestDomainNotCorrects extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 2;

    protected static ?string $heading = 'Últimos Domínios Incorretos';

    protected static ?string $description = 'Lista dos últimos domínios incorretos cadastrados.';

    public static function canView(): bool
    {
        // @phpstan-ignore-next-line
        return auth()->user()->role === UserRole::ADMIN;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                DomainNotCorrect::query()->latest()->limit(5)
            )
            ->paginated(false)
            ->columns([
                TextColumn::make('name')
                    ->label('Domínio Incorreto'),
                TextColumn::make('correct.name')
                    ->label('Domínio Correto'),
                TextColumn::make('created_at')
                    ->label('Data de Criação')
                    ->formatStateUsing(fn ($state): string => $state->format('d/m/Y H:i:s')),
            ]);
    }
}

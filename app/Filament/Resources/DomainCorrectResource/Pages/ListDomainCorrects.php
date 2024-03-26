<?php

namespace App\Filament\Resources\DomainCorrectResource\Pages;

use App\Filament\Resources\DomainCorrectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDomainCorrects extends ListRecords
{
    protected static string $resource = DomainCorrectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Incluir Domínio'),
        ];
    }
}

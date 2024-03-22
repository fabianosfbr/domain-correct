<?php

namespace App\Filament\Resources\DomainNotCorrectHistoricalResource\Pages;

use App\Filament\Resources\DomainNotCorrectHistoricalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDomainNotCorrectHistorical extends EditRecord
{
    protected static string $resource = DomainNotCorrectHistoricalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

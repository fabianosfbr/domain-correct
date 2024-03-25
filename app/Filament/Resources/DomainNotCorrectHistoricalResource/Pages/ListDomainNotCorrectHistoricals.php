<?php

namespace App\Filament\Resources\DomainNotCorrectHistoricalResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\DomainNotCorrectHistoricalResource;

class ListDomainNotCorrectHistoricals extends ListRecords
{
    protected static string $resource = DomainNotCorrectHistoricalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }


}

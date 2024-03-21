<?php

namespace App\Filament\Resources\DomainCorrectResource\Pages;

use App\Filament\Resources\DomainCorrectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDomainCorrect extends EditRecord
{
    protected static string $resource = DomainCorrectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

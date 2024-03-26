<?php

namespace App\Filament\Resources\DomainCorrectResource\Pages;

use App\Filament\Resources\DomainCorrectResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDomainCorrect extends CreateRecord
{
    protected static string $resource = DomainCorrectResource::class;

    protected ?string $heading = 'Incluir Domínio';
}

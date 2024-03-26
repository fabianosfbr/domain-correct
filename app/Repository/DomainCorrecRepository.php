<?php

namespace App\Repository;

use App\Models\DomainNotCorrect;
use App\Models\DomainNotCorrectHistorical;

class DomainCorrecRepository
{
    public function getNotDomainCorrect(string $email): ?DomainNotCorrect
    {
        $domain = explode('@', $email)[1];

        /** @phpstan-ignore-next-line */
        return DomainNotCorrect::with('correct')->where('name', $domain)->first();
    }

    public function historical(string $domain): ?DomainNotCorrectHistorical
    {
        return DomainNotCorrectHistorical::create(['name' => $domain]);
    }
}

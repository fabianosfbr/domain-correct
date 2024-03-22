<?php

namespace App\Repository;

use App\Models\DomainNotCorrect;
use App\Models\DomainNotCorrectHistorical;

class DomainCorrecRepository
{

    public function getNotDomainCorrect(string $email): DomainNotCorrect|null
    {
        $domain = explode('@', $email)[1];

        return DomainNotCorrect::with('correct')->where('address', $domain)->first();
    }


    public function historical(string $domain): DomainNotCorrectHistorical|null
    {

        return DomainNotCorrectHistorical::create(['address' => $domain]);
    }
}

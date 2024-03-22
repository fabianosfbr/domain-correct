<?php

namespace App\Repository;

use App\Models\DomainNotCorrect;

class DomainCorrecRepository
{

    public function getNotDomainCorrect(string $email): DomainNotCorrect|null
    {
        $domain = explode('@', $email)[1];

        return DomainNotCorrect::with('correct')->where('address', $domain)->first();
    }
}

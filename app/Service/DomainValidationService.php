<?php

namespace App\Service;

use App\Repository\DomainCorrecRepository;
use Illuminate\Support\Collection;

class DomainValidationService
{
    public function __construct(
        private readonly DomainCorrecRepository $domainRepository
    ) {
    }

    public function validate(Collection $data): Collection
    {

        return $data->map(function ($item) {

            $userDomain = explode('@', $item['email']);

            $checkMx = checkdnsrr($userDomain[1], 'MX');

            $validated = null;

            if (!$checkMx) {

                $validated = $this->domainRepository->getNotDomainCorrect($item['email']);
                //Disparar evento para loggar
                //event(new DomainValidateEvent($item['email'], $validated?->address ?? $userDomain[1], $validated?->correct->address));

            }
            return [
                'email' => $item['email'],
                'is_valid' => $checkMx,
                'user' => $userDomain[0],
                'domain' => $validated?->address ?? $userDomain[1],
                'sugestion' => $validated?->correct->address,
            ];
        });
    }
}

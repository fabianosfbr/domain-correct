<?php

namespace App\Service;

use Illuminate\Support\Collection;
use App\Repository\DomainCorrecRepository;
use App\Events\DomainNotValidateHistoricalEvent;

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

                if (!$validated) {
                    event(new DomainNotValidateHistoricalEvent($userDomain[1]));
                }
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

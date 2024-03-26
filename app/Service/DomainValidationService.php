<?php

namespace App\Service;

use App\Events\DomainNotValidateHistoricalEvent;
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

            if (! $checkMx) {

                $validated = $this->domainRepository->getNotDomainCorrect($item['email']);

                if (! $validated) {
                    event(new DomainNotValidateHistoricalEvent($userDomain[1]));
                }

            }

            return [
                'email' => $item['email'],
                'is_valid' => $checkMx,
                'user' => $userDomain[0],
                'domain' => $validated?->name ?? $userDomain[1],
                'sugestion' => $validated?->correct->name,  /** @phpstan-ignore-line */
            ];
        });
    }
}

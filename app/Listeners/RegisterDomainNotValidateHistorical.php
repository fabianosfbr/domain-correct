<?php

namespace App\Listeners;

use App\Events\DomainNotValidateHistoricalEvent;
use App\Repository\DomainCorrecRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterDomainNotValidateHistorical implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private readonly DomainCorrecRepository $domainRepository
    ) {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DomainNotValidateHistoricalEvent $event): void
    {
        $this->domainRepository->historical($event->domain);
    }
}

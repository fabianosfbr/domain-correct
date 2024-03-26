<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('play', function () {

    $email = 'email@gmaill.com';

    $repository = new \App\Repository\DomainCorrecRepository();
    $domain = $repository->getNotDomainCorrect($email);

    dd($domain->correct->address);

});

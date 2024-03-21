<?php

use App\Models\EmailFrom;
use App\Models\EmailTo;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('play', function () {
    $emailTo = EmailTo::where('address', '9v5XG@example.com')->first();


    $emailTo->emailsFrom()->create(['address', 'exaample.com']);

});

<?php

use App\Models\User;
use Illuminate\Support\Facades\Artisan;

Artisan::command('play', function () {
    $user = User::first();

    dd($user);
});

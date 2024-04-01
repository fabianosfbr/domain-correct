<?php

use App\Models\User;
use Illuminate\Support\Facades\Artisan;

Artisan::command('play', function () {
    $user = User::all();

    dd($user);
});

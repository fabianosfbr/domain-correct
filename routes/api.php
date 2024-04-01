<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
    ->prefix('email')
    ->group(function () {
        Route::post('/validate', [EmailController::class, 'validate'])->name('email.validate');
    });

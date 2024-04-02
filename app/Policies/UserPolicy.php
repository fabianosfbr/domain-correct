<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function accessDomainCorrectResource(User $user): Response
    {
        return $user->role === UserRole::ADMIN
            ? Response::allow()
            : Response::deny('Você não tem permissão para acessar este recurso.');
    }

    public function accessNotCorrectHistoricalResource(User $user): Response
    {
        return $user->role === UserRole::ADMIN
            ? Response::allow()
            : Response::deny('Você não tem permissão para acessar este recurso.');
    }
}

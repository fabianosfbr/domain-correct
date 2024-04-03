<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case CLIENT = 'client';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrador',
            self::CLIENT => 'Cliente',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::ADMIN => 'primary',
            self::CLIENT => 'success',
        };
    }
}

<?php

namespace App\Enums\Auth;

enum UserRole: string
{
    case ADMIN = 'admin';
    case CLIENT = 'client';
    case PROVIDER = 'service provider';

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Administrador',
            self::CLIENT => 'Cliente',
            self::PROVIDER => 'Prestador de Serviço',
        };
    }
}

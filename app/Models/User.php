<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public const ROLE_CLIENTE = 'cliente';
    public const ROLE_EMPLEADO = 'empleado';
    public const ROLE_GERENTE = 'gerente';

    public const ROLES = [
        self::ROLE_CLIENTE,
        self::ROLE_EMPLEADO,
        self::ROLE_GERENTE,
    ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // se encripta automáticamente al asignar
        ];
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function isGerente(): bool
    {
        return $this->role === self::ROLE_GERENTE;
    }
}

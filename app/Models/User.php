<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'nivel_acesso',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function possuiAcessoGerencial(): bool
    {
        return in_array($this->nivelAcesso(), ['GERENTE', 'ADMIN'], true);
    }

    public function nivelAcesso(): string
    {
        $nivel = (string) ($this->nivel_acesso ?? 'OPERADOR');
        return in_array($nivel, ['OPERADOR', 'GERENTE', 'ADMIN'], true) ? $nivel : 'OPERADOR';
    }

    public function hasPermission(string $permission): bool
    {
        $permissions = config('rbac.permissions_by_role.' . $this->nivelAcesso(), []);

        if (in_array('*', $permissions, true)) {
            return true;
        }

        return in_array($permission, $permissions, true);
    }
}

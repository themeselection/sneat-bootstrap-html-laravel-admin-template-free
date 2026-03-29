<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAccessSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            ['name' => 'Administrador', 'email' => 'admin@jbtintas.local', 'nivel_acesso' => 'ADMIN'],
            ['name' => 'Gerente', 'email' => 'gerente@jbtintas.local', 'nivel_acesso' => 'GERENTE'],
            ['name' => 'Operador', 'email' => 'operador@jbtintas.local', 'nivel_acesso' => 'OPERADOR'],
        ];

        foreach ($usuarios as $dados) {
            User::updateOrCreate(
                ['email' => $dados['email']],
                [
                    'name' => $dados['name'],
                    'nivel_acesso' => $dados['nivel_acesso'],
                    'password' => Hash::make('12345678'),
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}


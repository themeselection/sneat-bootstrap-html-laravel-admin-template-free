<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class RbacPermissionTest extends TestCase
{
    public function test_admin_has_wildcard_access(): void
    {
        $user = new User(['nivel_acesso' => 'ADMIN']);

        $this->assertTrue($user->hasPermission('usuarios.manage'));
        $this->assertTrue($user->hasPermission('qualquer.permissao'));
    }

    public function test_operador_has_expected_permissions_and_restrictions(): void
    {
        $user = new User(['nivel_acesso' => 'OPERADOR']);

        $this->assertTrue($user->hasPermission('clientes.view'));
        $this->assertTrue($user->hasPermission('financeiro.contas_receber.baixar'));
        $this->assertFalse($user->hasPermission('financeiro.contas_receber.estornar'));
        $this->assertFalse($user->hasPermission('usuarios.manage'));
    }
}


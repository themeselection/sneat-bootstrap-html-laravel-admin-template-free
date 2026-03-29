<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class RbacRoutesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware(['web', 'auth', 'perm:clientes.view'])
            ->get('/_test/rbac/clientes-view', fn () => response('ok', 200));

        Route::middleware(['web', 'auth', 'perm:auditoria.view'])
            ->get('/_test/rbac/auditoria-view', fn () => response('ok', 200));
    }

    public function test_operador_can_access_route_with_allowed_permission(): void
    {
        $user = new User(['nivel_acesso' => 'OPERADOR']);
        $this->actingAs($user);

        $response = $this->get('/_test/rbac/clientes-view');

        $response->assertOk();
    }

    public function test_operador_cannot_access_route_without_permission(): void
    {
        $user = new User(['nivel_acesso' => 'OPERADOR']);
        $this->actingAs($user);

        $response = $this->get('/_test/rbac/auditoria-view');

        $response->assertForbidden();
    }

    public function test_guest_is_redirected_by_auth_middleware(): void
    {
        $response = $this->get('/_test/rbac/clientes-view');

        $response->assertStatus(302);
    }
}


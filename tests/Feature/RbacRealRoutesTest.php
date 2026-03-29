<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class RbacRealRoutesTest extends TestCase
{
    public function test_operador_can_access_usuarios_permissoes_view_route(): void
    {
        $this->actingAs(new User(['nivel_acesso' => 'OPERADOR']));

        $response = $this->get('/usuarios/permissoes');

        $response->assertOk();
    }

    public function test_operador_cannot_access_auditoria_route(): void
    {
        $this->actingAs(new User(['nivel_acesso' => 'OPERADOR']));

        $response = $this->get('/auditoria');

        $response->assertForbidden();
    }

    public function test_operador_cannot_import_legacy_pdf_route(): void
    {
        $this->actingAs(new User(['nivel_acesso' => 'OPERADOR']));

        $response = $this->post('/documentos-comerciais/importar-pdf-legado', []);

        $response->assertForbidden();
    }

    public function test_gerente_can_reach_legacy_import_route_and_get_validation_redirect(): void
    {
        $this->actingAs(new User(['nivel_acesso' => 'GERENTE']));

        $response = $this->post('/documentos-comerciais/importar-pdf-legado', []);

        $response->assertStatus(302);
    }
}


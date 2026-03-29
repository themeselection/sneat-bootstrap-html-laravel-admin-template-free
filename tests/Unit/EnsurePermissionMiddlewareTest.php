<?php

namespace Tests\Unit;

use App\Http\Middleware\EnsurePermission;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class EnsurePermissionMiddlewareTest extends TestCase
{
    public function test_middleware_allows_user_with_permission(): void
    {
        $request = Request::create('/fake', 'GET');
        $request->setUserResolver(fn () => new User(['nivel_acesso' => 'GERENTE']));

        $middleware = new EnsurePermission();

        $response = $middleware->handle($request, fn () => new Response('ok', 200), 'auditoria.view');

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test_middleware_blocks_user_without_permission(): void
    {
        $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);

        $request = Request::create('/fake', 'GET');
        $request->setUserResolver(fn () => new User(['nivel_acesso' => 'OPERADOR']));

        $middleware = new EnsurePermission();
        $middleware->handle($request, fn () => new Response('ok', 200), 'auditoria.view');
    }
}


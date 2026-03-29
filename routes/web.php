<?php

use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\administrativo\AuditoriaController;
use App\Http\Controllers\administrativo\UsuarioController;
use App\Http\Controllers\cadastros\CategoriaProdutoController;
use App\Http\Controllers\cadastros\TabelaPrecoController;
use App\Http\Controllers\cadastros\UnidadeMedidaController;
use App\Http\Controllers\clientes\ClienteController;
use App\Http\Controllers\compras\CompraController;
use App\Http\Controllers\compras\FornecedorController;
use App\Http\Controllers\comercial\DocumentoComercialController;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\estoque\AlertaEstoqueController;
use App\Http\Controllers\estoque\MovimentacaoEstoqueController;
use App\Http\Controllers\financeiro\ContaPagarController;
use App\Http\Controllers\financeiro\ContaReceberController;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\produtos\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
    Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
    Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-forgot-password-basic');
});

Route::middleware('auth')->group(function () {
    Route::middleware('perm:dashboard.view')->group(function () {
        Route::get('/', [Analytics::class, 'index'])->name('dashboard-analytics');
        Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard');
        Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
        Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
        Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-connections');
    });

    Route::middleware('perm:usuarios.view')->group(function () {
        Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/permissoes', [UsuarioController::class, 'permissoes'])->name('usuarios.permissoes');
    });

    Route::middleware('perm:usuarios.manage')->group(function () {
        Route::put('/usuarios/{user}/acesso', [UsuarioController::class, 'updateAcesso'])->name('usuarios.update-acesso');
    });

    Route::middleware('perm:auditoria.view')->group(function () {
        Route::get('/auditoria', [AuditoriaController::class, 'index'])->name('auditoria.index');
        Route::get('/auditoria/exportar-csv', [AuditoriaController::class, 'exportCsv'])->name('auditoria.export-csv');
    });

    Route::middleware('perm:clientes.view')->group(function () {
        Route::get('/clientes/exportar-csv', [ClienteController::class, 'exportCsv'])->name('clientes.export-csv');
        Route::resource('clientes', ClienteController::class)->only(['index', 'show']);
    });

    Route::middleware('perm:clientes.manage')->group(function () {
        Route::get('/clientes/cnpj/{cnpj}', [ClienteController::class, 'buscarCnpj'])->name('clientes.buscar-cnpj');
        Route::get('/clientes/cidades/{uf}', [ClienteController::class, 'cidadesPorUf'])->name('clientes.cidades-uf');
        Route::resource('clientes', ClienteController::class)->except(['index', 'show']);
    });

    Route::middleware('perm:compras.fornecedores.view')->group(function () {
        Route::get('/fornecedores/exportar-csv', [FornecedorController::class, 'exportCsv'])->name('fornecedores.export-csv');
        Route::get('/fornecedores', [FornecedorController::class, 'index'])->name('fornecedores.index');
    });

    Route::middleware('perm:compras.fornecedores.manage')->group(function () {
        Route::resource('fornecedores', FornecedorController::class)->parameters(['fornecedores' => 'fornecedor'])->except(['index', 'show']);
    });

    Route::middleware('perm:compras.compras.view')->group(function () {
        Route::get('/compras/exportar-csv', [CompraController::class, 'exportCsv'])->name('compras.export-csv');
        Route::resource('compras', CompraController::class)->only(['index', 'show']);
    });

    Route::middleware('perm:compras.compras.manage')->group(function () {
        Route::resource('compras', CompraController::class)->only(['create', 'store']);
    });

    Route::middleware('perm:produtos.view')->group(function () {
        Route::get('produtos/exportar-csv', [ProdutoController::class, 'exportCsv'])->name('produtos.export-csv');
        Route::resource('produtos', ProdutoController::class)->only(['index', 'show']);
    });

    Route::middleware('perm:produtos.manage')->group(function () {
        Route::get('produtos/importar/template', [ProdutoController::class, 'importTemplate'])->name('produtos.importar.template');
        Route::post('produtos/importar', [ProdutoController::class, 'import'])->name('produtos.importar');
        Route::resource('produtos', ProdutoController::class)->except(['index', 'show']);
    });

    Route::middleware('perm:cadastros_base.view')->group(function () {
        Route::resource('categorias-produto', CategoriaProdutoController::class)->parameters(['categorias-produto' => 'categoria_produto'])->only(['index']);
        Route::resource('unidades-medida', UnidadeMedidaController::class)->parameters(['unidades-medida' => 'unidade_medida'])->only(['index']);
        Route::resource('tabelas-preco', TabelaPrecoController::class)->parameters(['tabelas-preco' => 'tabela_preco'])->only(['index']);
    });

    Route::middleware('perm:cadastros_base.manage')->group(function () {
        Route::resource('categorias-produto', CategoriaProdutoController::class)->parameters(['categorias-produto' => 'categoria_produto'])->except(['index', 'show']);
        Route::resource('unidades-medida', UnidadeMedidaController::class)->parameters(['unidades-medida' => 'unidade_medida'])->except(['index', 'show']);
        Route::resource('tabelas-preco', TabelaPrecoController::class)->parameters(['tabelas-preco' => 'tabela_preco'])->except(['index', 'show']);
    });

    Route::middleware('perm:estoque.movimentacoes.view')->group(function () {
        Route::resource('movimentacoes-estoque', MovimentacaoEstoqueController::class)->only(['index']);
    });

    Route::middleware('perm:estoque.movimentacoes.manage')->group(function () {
        Route::get('movimentacoes-estoque/lotes/{produto}', [MovimentacaoEstoqueController::class, 'lotesPorProduto'])->name('movimentacoes-estoque.lotes');
        Route::resource('movimentacoes-estoque', MovimentacaoEstoqueController::class)->only(['create', 'store']);
    });

    Route::middleware('perm:estoque.alertas.view')->group(function () {
        Route::get('estoque/alertas', [AlertaEstoqueController::class, 'index'])->name('estoque.alertas.index');
    });

    Route::middleware('perm:financeiro.contas_receber.view')->group(function () {
        Route::get('contas-receber', [ContaReceberController::class, 'index'])->name('contas-receber.index');
        Route::get('contas-receber/exportar-csv', [ContaReceberController::class, 'exportCsv'])->name('contas-receber.export-csv');
        Route::get('contas-receber/{conta}', [ContaReceberController::class, 'show'])->name('contas-receber.show');
        Route::get('contas-receber/{conta}/extrato/exportar-csv', [ContaReceberController::class, 'exportExtratoCsv'])->name('contas-receber.extrato.export-csv');
    });

    Route::middleware('perm:financeiro.contas_receber.baixar')->group(function () {
        Route::post('contas-receber/{conta}/baixar', [ContaReceberController::class, 'baixar'])->name('contas-receber.baixar');
    });
    Route::middleware('perm:financeiro.contas_receber.estornar')->post('contas-receber/{conta}/estornar', [ContaReceberController::class, 'estornar'])->name('contas-receber.estornar');

    Route::middleware('perm:financeiro.contas_pagar.view')->group(function () {
        Route::get('contas-pagar', [ContaPagarController::class, 'index'])->name('contas-pagar.index');
        Route::get('contas-pagar/exportar-csv', [ContaPagarController::class, 'exportCsv'])->name('contas-pagar.export-csv');
        Route::get('contas-pagar/{conta}', [ContaPagarController::class, 'show'])->name('contas-pagar.show');
        Route::get('contas-pagar/{conta}/extrato/exportar-csv', [ContaPagarController::class, 'exportExtratoCsv'])->name('contas-pagar.extrato.export-csv');
    });
    Route::middleware('perm:financeiro.contas_pagar.pagar')->group(function () {
        Route::post('contas-pagar/{conta}/pagar', [ContaPagarController::class, 'pagar'])->name('contas-pagar.pagar');
    });
    Route::middleware('perm:financeiro.contas_pagar.estornar')->group(function () {
        Route::post('contas-pagar/{conta}/estornar', [ContaPagarController::class, 'estornar'])->name('contas-pagar.estornar');
    });

    Route::middleware('perm:vendas.pdv.use')->group(function () {
        Route::get('pdv', [DocumentoComercialController::class, 'pdv'])->name('pdv.index');
        Route::post('pdv/finalizar', [DocumentoComercialController::class, 'pdvFinalizar'])->name('pdv.finalizar');
    });

    Route::middleware('perm:vendas.documentos.converter')->group(function () {
        Route::post('documentos-comerciais/{documento}/converter-pedido', [DocumentoComercialController::class, 'converterPedido'])->name('documentos-comerciais.converter-pedido');
        Route::post('documentos-comerciais/{documento}/converter-venda', [DocumentoComercialController::class, 'converterVenda'])->name('documentos-comerciais.converter-venda');
    });

    Route::middleware('perm:vendas.documentos.faturar')->group(function () {
        Route::post('documentos-comerciais/{documento}/faturar', [DocumentoComercialController::class, 'faturar'])->name('documentos-comerciais.faturar');
    });

    Route::middleware('perm:vendas.documentos.cancelar')->group(function () {
        Route::post('documentos-comerciais/{documento}/reabrir', [DocumentoComercialController::class, 'reabrir'])->name('documentos-comerciais.reabrir');
    });

    Route::middleware('perm:vendas.documentos.importar_legado')->group(function () {
        Route::post('documentos-comerciais/importar-pdf-legado', [DocumentoComercialController::class, 'importarPdfLegado'])->name('documentos-comerciais.importar-pdf-legado');
    });

    Route::middleware('perm:vendas.documentos.view')->group(function () {
        Route::get('documentos-comerciais/exportar-csv', [DocumentoComercialController::class, 'exportCsv'])->name('documentos-comerciais.export-csv');
        Route::resource('documentos-comerciais', DocumentoComercialController::class)->parameters(['documentos-comerciais' => 'documento'])->only(['index', 'show']);
        Route::get('documentos-comerciais/{documento}/analise', [DocumentoComercialController::class, 'analise'])->name('documentos-comerciais.analise');
        Route::get('documentos-comerciais/{documento}/analise/exportar-csv', [DocumentoComercialController::class, 'exportAnaliseCsv'])->name('documentos-comerciais.analise.export-csv');
    });

    Route::middleware('perm:vendas.documentos.manage')->group(function () {
        Route::get('documentos-comerciais/produtos/busca', [DocumentoComercialController::class, 'buscarProdutos'])->name('documentos-comerciais.buscar-produtos');
        Route::get('documentos-comerciais/clientes/busca', [DocumentoComercialController::class, 'buscarClientes'])->name('documentos-comerciais.buscar-clientes');
        Route::resource('documentos-comerciais', DocumentoComercialController::class)->parameters(['documentos-comerciais' => 'documento'])->except(['index', 'show']);
    });
});

require __DIR__.'/auth.php';

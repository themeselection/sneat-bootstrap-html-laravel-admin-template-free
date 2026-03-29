<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('documentos_comerciais', function (Blueprint $table) {
            $table->id();
            $table->string('numero', 30)->unique();
            $table->enum('tipo', ['ORCAMENTO', 'PREVENDA', 'PEDIDO', 'VENDA'])->index();
            $table->enum('status', [
                'RASCUNHO',
                'PENDENTE',
                'AGUARDANDO_PAGAMENTO',
                'EM_SEPARACAO',
                'AGUARDANDO_FATURAMENTO',
                'CONCLUIDO',
                'FATURADO',
                'CANCELADO',
            ])->index();
            $table->foreignId('documento_origem_id')->nullable()->constrained('documentos_comerciais')->nullOnDelete();
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('vendedor_id')->constrained('users');
            $table->foreignId('operador_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('filial_id')->constrained('filiais');
            $table->foreignId('tabela_preco_id')->nullable()->constrained('tabelas_preco')->nullOnDelete();
            $table->dateTime('data_emissao');
            $table->date('validade_orcamento')->nullable();
            $table->decimal('subtotal', 14, 2)->default(0);
            $table->decimal('desconto_total', 14, 2)->default(0);
            $table->decimal('acrescimo_total', 14, 2)->default(0);
            $table->decimal('impostos_total', 14, 2)->default(0);
            $table->decimal('total_liquido', 14, 2)->default(0);
            $table->text('observacoes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentos_comerciais');
    }
};

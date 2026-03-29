<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('documento_itens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('documento_id')->constrained('documentos_comerciais')->cascadeOnDelete();
            $table->unsignedInteger('sequencia');
            $table->foreignId('produto_id')->constrained('produtos');
            $table->string('descricao', 255);
            $table->string('unidade_sigla', 20);
            $table->decimal('quantidade', 14, 3);
            $table->decimal('preco_tabela', 14, 4)->default(0);
            $table->decimal('preco_unitario', 14, 4)->default(0);
            $table->decimal('subtotal_bruto', 14, 2)->default(0);
            $table->decimal('subtotal_liquido', 14, 2)->default(0);
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['documento_id', 'sequencia']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documento_itens');
    }
};

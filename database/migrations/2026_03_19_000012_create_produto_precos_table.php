<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('produto_precos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained('produtos')->cascadeOnDelete();
            $table->foreignId('tabela_preco_id')->constrained('tabelas_preco');
            $table->decimal('preco', 12, 4);
            $table->decimal('custo_referencia', 12, 4)->nullable();
            $table->decimal('margem_percentual', 7, 4)->nullable();
            $table->dateTime('vigencia_inicio')->nullable();
            $table->dateTime('vigencia_fim')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();

            $table->unique(['produto_id', 'tabela_preco_id', 'vigencia_inicio'], 'produto_preco_vigencia_unique');
            $table->index(['produto_id', 'tabela_preco_id', 'ativo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produto_precos');
    }
};

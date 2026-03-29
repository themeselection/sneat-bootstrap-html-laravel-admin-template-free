<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('sku', 40)->unique();
            $table->string('nome')->index();
            $table->text('descricao')->nullable();
            $table->string('codigo_barras', 50)->nullable()->unique();
            $table->foreignId('categoria_id')->constrained('categorias_produto');
            $table->foreignId('unidade_principal_id')->constrained('unidades_medida');
            $table->boolean('controla_lote')->default(false);
            $table->boolean('controla_validade')->default(false);
            $table->boolean('ativo')->default(true)->index();
            $table->boolean('permite_venda')->default(true);
            $table->boolean('permite_compra')->default(true);
            $table->string('ncm', 20)->nullable()->index();
            $table->string('cest', 20)->nullable()->index();
            $table->string('marca', 120)->nullable();
            $table->text('observacoes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};

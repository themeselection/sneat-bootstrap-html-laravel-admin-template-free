<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('compra_itens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compra_id')->constrained('compras')->cascadeOnDelete();
            $table->unsignedInteger('sequencia');
            $table->foreignId('produto_id')->constrained('produtos');
            $table->decimal('quantidade', 14, 3);
            $table->decimal('preco_unitario', 14, 4);
            $table->decimal('subtotal', 14, 2);
            $table->string('numero_lote', 80)->nullable();
            $table->date('data_validade')->nullable();
            $table->timestamps();

            $table->index(['compra_id', 'sequencia']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compra_itens');
    }
};

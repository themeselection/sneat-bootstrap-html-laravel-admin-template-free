<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contas_pagar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compra_id')->constrained('compras')->cascadeOnDelete();
            $table->foreignId('fornecedor_id')->constrained('fornecedores');
            $table->decimal('valor_original', 14, 2)->default(0);
            $table->decimal('valor_aberto', 14, 2)->default(0);
            $table->date('vencimento');
            $table->enum('status', ['ABERTO', 'PARCIAL', 'QUITADO', 'CANCELADO'])->default('ABERTO')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contas_pagar');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contas_receber', function (Blueprint $table) {
            $table->id();
            $table->foreignId('documento_id')->constrained('documentos_comerciais')->cascadeOnDelete();
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->decimal('valor_original', 14, 2)->default(0);
            $table->decimal('valor_aberto', 14, 2)->default(0);
            $table->date('vencimento');
            $table->enum('status', ['ABERTO', 'PARCIAL', 'QUITADO', 'CANCELADO'])->default('ABERTO');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contas_receber');
    }
};

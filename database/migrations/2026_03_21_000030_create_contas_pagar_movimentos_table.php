<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contas_pagar_movimentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conta_pagar_id')->constrained('contas_pagar')->cascadeOnDelete();
            $table->foreignId('usuario_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('tipo', ['PAGAMENTO', 'ESTORNO'])->index();
            $table->decimal('valor', 14, 2);
            $table->dateTime('data_movimento');
            $table->string('forma_pagamento', 50)->nullable();
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contas_pagar_movimentos');
    }
};


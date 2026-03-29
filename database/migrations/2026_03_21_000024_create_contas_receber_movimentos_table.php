<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contas_receber_movimentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conta_receber_id')->constrained('contas_receber')->cascadeOnDelete();
            $table->foreignId('usuario_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('tipo', ['RECEBIMENTO', 'ESTORNO'])->index();
            $table->decimal('valor', 14, 2);
            $table->dateTime('data_movimento');
            $table->string('forma_pagamento', 50)->nullable();
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contas_receber_movimentos');
    }
};

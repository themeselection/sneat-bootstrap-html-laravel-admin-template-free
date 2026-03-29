<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('estoque_movimentacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained('produtos')->cascadeOnDelete();
            $table->foreignId('estoque_lote_id')->nullable()->constrained('estoque_lotes')->nullOnDelete();
            $table->enum('tipo', ['ENTRADA', 'SAIDA', 'AJUSTE'])->index();
            $table->string('origem', 40);
            $table->string('documento_ref', 80)->nullable()->index();
            $table->decimal('quantidade', 14, 3);
            $table->smallInteger('sinal');
            $table->decimal('saldo_apos', 14, 3);
            $table->text('observacao')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estoque_movimentacoes');
    }
};

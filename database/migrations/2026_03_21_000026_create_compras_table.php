<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->string('numero', 30)->unique();
            $table->foreignId('fornecedor_id')->constrained('fornecedores');
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('filial_id')->constrained('filiais');
            $table->dateTime('data_compra');
            $table->enum('status', ['RASCUNHO', 'CONFIRMADA', 'CANCELADA'])->default('CONFIRMADA')->index();
            $table->decimal('valor_total', 14, 2)->default(0);
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};

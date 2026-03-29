<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('estoque_reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('documento_item_id')->unique()->constrained('documento_itens')->cascadeOnDelete();
            $table->foreignId('produto_id')->constrained('produtos');
            $table->decimal('quantidade_reservada', 14, 3);
            $table->enum('status', ['ATIVA', 'CONSUMIDA', 'CANCELADA'])->default('ATIVA');
            $table->dateTime('data_reserva');
            $table->dateTime('data_consumo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estoque_reservas');
    }
};

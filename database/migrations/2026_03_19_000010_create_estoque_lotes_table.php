<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('estoque_lotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained('produtos')->cascadeOnDelete();
            $table->string('lote', 80);
            $table->string('serial', 120)->nullable();
            $table->date('validade')->nullable()->index();
            $table->decimal('quantidade_disponivel', 14, 3)->default(0);
            $table->decimal('custo_unitario', 12, 4)->nullable();
            $table->timestamps();

            $table->unique(['produto_id', 'lote', 'serial']);
            $table->index(['produto_id', 'lote']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estoque_lotes');
    }
};

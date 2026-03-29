<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('produto_unidades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained('produtos')->cascadeOnDelete();
            $table->foreignId('unidade_id')->constrained('unidades_medida');
            $table->decimal('fator_conversao', 12, 4);
            $table->string('codigo_barras', 50)->nullable()->unique();
            $table->boolean('ativo')->default(true);
            $table->timestamps();

            $table->unique(['produto_id', 'unidade_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produto_unidades');
    }
};

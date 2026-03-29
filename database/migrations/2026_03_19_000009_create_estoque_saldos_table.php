<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('estoque_saldos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->unique()->constrained('produtos')->cascadeOnDelete();
            $table->decimal('quantidade_atual', 14, 3)->default(0);
            $table->decimal('estoque_minimo', 14, 3)->default(0);
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estoque_saldos');
    }
};

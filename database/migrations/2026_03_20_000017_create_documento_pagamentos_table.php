<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('documento_pagamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('documento_id')->constrained('documentos_comerciais')->cascadeOnDelete();
            $table->string('forma_pagamento', 50);
            $table->decimal('valor', 14, 2);
            $table->unsignedInteger('parcelas')->default(1);
            $table->string('autorizacao', 80)->nullable();
            $table->enum('status', ['PENDENTE', 'AUTORIZADO', 'NEGADO', 'ESTORNADO'])->default('PENDENTE');
            $table->dateTime('data_pagamento')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documento_pagamentos');
    }
};

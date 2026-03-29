<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('documento_eventos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('documento_id')->constrained('documentos_comerciais')->cascadeOnDelete();
            $table->string('status_anterior', 50)->nullable();
            $table->string('status_novo', 50);
            $table->string('acao', 60);
            $table->foreignId('usuario_id')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('data_evento');
            $table->json('detalhes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documento_eventos');
    }
};

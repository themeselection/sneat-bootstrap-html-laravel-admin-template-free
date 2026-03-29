<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('faturamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('documento_id')->unique()->constrained('documentos_comerciais')->cascadeOnDelete();
            $table->string('numero_fiscal', 60)->nullable()->unique();
            $table->string('chave_acesso', 60)->nullable()->unique();
            $table->enum('status_fiscal', ['PENDENTE', 'AUTORIZADO', 'REJEITADO', 'CANCELADO'])->default('PENDENTE');
            $table->string('xml_path', 255)->nullable();
            $table->string('pdf_path', 255)->nullable();
            $table->dateTime('data_faturamento');
            $table->text('erro_fiscal')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faturamentos');
    }
};

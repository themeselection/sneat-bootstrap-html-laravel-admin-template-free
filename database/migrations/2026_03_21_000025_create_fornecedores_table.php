<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 180)->index();
            $table->string('cnpj', 18)->nullable()->unique();
            $table->string('telefone', 30)->nullable();
            $table->string('email', 180)->nullable();
            $table->text('endereco')->nullable();
            $table->string('contato', 120)->nullable();
            $table->boolean('ativo')->default(true)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fornecedores');
    }
};

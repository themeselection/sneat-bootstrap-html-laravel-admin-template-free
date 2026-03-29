<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20)->nullable()->unique();
            $table->enum('tipo_pessoa', ['PF', 'PJ'])->index();
            $table->string('nome');
            $table->string('nome_fantasia')->nullable();
            $table->string('cpf_cnpj', 18)->unique();
            $table->string('rg_ie', 30)->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('telefone', 20)->nullable();
            $table->string('celular', 20)->nullable();
            $table->string('contato_nome', 120)->nullable();
            $table->string('cep', 9)->nullable()->index();
            $table->string('logradouro')->nullable();
            $table->string('numero', 20)->nullable();
            $table->string('complemento', 120)->nullable();
            $table->string('bairro', 120)->nullable();
            $table->string('cidade', 120)->nullable()->index();
            $table->char('uf', 2)->nullable()->index();
            $table->string('codigo_ibge', 10)->nullable();
            $table->string('pais', 80)->default('Brasil');
            $table->date('data_nascimento_fundacao')->nullable();
            $table->enum('sexo', ['M', 'F', 'N'])->nullable();
            $table->text('observacoes')->nullable();
            $table->boolean('ativo')->default(true)->index();
            $table->decimal('saldo_credito', 12, 2)->default(0);
            $table->decimal('limite_prazo', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};

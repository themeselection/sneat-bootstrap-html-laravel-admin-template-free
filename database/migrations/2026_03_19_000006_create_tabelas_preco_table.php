<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tabelas_preco', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 120)->unique();
            $table->string('codigo', 40)->unique();
            $table->enum('tipo', ['VAREJO', 'ATACADO', 'PROMOCAO', 'ESPECIAL']);
            $table->boolean('ativo')->default(true);
            $table->smallInteger('prioridade')->default(0);
            $table->timestamps();
        });

        DB::table('tabelas_preco')->insert([
            [
                'nome' => 'Tabela Varejo',
                'codigo' => 'VAREJO',
                'tipo' => 'VAREJO',
                'ativo' => true,
                'prioridade' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('tabelas_preco');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('unidades_medida', function (Blueprint $table) {
            $table->id();
            $table->string('sigla', 20)->unique();
            $table->string('nome', 80);
            $table->unsignedTinyInteger('casas_decimais')->default(3);
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });

        DB::table('unidades_medida')->insert([
            ['sigla' => 'UN', 'nome' => 'Unidade', 'casas_decimais' => 0, 'ativo' => true, 'created_at' => now(), 'updated_at' => now()],
            ['sigla' => 'L', 'nome' => 'Litro', 'casas_decimais' => 3, 'ativo' => true, 'created_at' => now(), 'updated_at' => now()],
            ['sigla' => 'GL3.6', 'nome' => 'Galao 3.6L', 'casas_decimais' => 3, 'ativo' => true, 'created_at' => now(), 'updated_at' => now()],
            ['sigla' => 'LT18', 'nome' => 'Lata 18L', 'casas_decimais' => 3, 'ativo' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('unidades_medida');
    }
};

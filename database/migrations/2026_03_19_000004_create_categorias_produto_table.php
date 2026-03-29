<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categorias_produto', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 120)->unique();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });

        DB::table('categorias_produto')->insert([
            ['nome' => 'Tinta Acrilica', 'ativo' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Solvente', 'ativo' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Pincel', 'ativo' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Rolo', 'ativo' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Acessorio', 'ativo' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('categorias_produto');
    }
};

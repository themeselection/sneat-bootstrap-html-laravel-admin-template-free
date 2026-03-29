<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('filiais', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 120);
            $table->string('codigo', 30)->unique();
            $table->boolean('ativa')->default(true);
            $table->timestamps();
        });

        DB::table('filiais')->insert([
            'nome' => 'Matriz',
            'codigo' => 'MAT',
            'ativa' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('filiais');
    }
};

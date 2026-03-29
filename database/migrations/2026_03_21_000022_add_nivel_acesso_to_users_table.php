<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('nivel_acesso', ['OPERADOR', 'GERENTE', 'ADMIN'])
                ->default('ADMIN')
                ->after('email');
        });

        DB::table('users')->whereNull('nivel_acesso')->update(['nivel_acesso' => 'ADMIN']);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nivel_acesso');
        });
    }
};

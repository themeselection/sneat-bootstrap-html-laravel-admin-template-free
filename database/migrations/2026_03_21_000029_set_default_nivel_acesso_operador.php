<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::table('users')->whereNull('nivel_acesso')->update(['nivel_acesso' => 'OPERADOR']);

        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY nivel_acesso ENUM('OPERADOR','GERENTE','ADMIN') NOT NULL DEFAULT 'OPERADOR'");
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY nivel_acesso ENUM('OPERADOR','GERENTE','ADMIN') NOT NULL DEFAULT 'ADMIN'");
        }
    }
};


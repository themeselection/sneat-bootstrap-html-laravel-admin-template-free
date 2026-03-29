<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('estoque_saldos', function (Blueprint $table) {
            $table->decimal('quantidade_reservada', 14, 3)->default(0)->after('quantidade_atual');
        });

        Schema::table('estoque_movimentacoes', function (Blueprint $table) {
            $table->string('origem_tipo', 50)->nullable()->after('origem');
            $table->unsignedBigInteger('origem_id')->nullable()->after('origem_tipo');
            $table->foreignId('estoque_reserva_id')->nullable()->after('estoque_lote_id')->constrained('estoque_reservas')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('estoque_movimentacoes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('estoque_reserva_id');
            $table->dropColumn(['origem_tipo', 'origem_id']);
        });

        Schema::table('estoque_saldos', function (Blueprint $table) {
            $table->dropColumn('quantidade_reservada');
        });
    }
};

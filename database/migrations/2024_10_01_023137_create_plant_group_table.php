<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('plant_group', function (Blueprint $table) {
      $table->id();
      $table->string('pg');
    });

    DB::table('plant_group')->insert([
      ['pg' => 'PG1'],
      ['pg' => 'PG2'],
      ['pg' => 'PG3'],
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('plant_group');
  }
};

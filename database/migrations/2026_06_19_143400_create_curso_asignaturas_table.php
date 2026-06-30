<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('curso_asignaturas', function (Blueprint $table) {

        $table->foreignId('curso_id')
              ->constrained('curso')
              ->cascadeOnDelete();

        $table->foreignId('asignatura_id')
              ->constrained('asignaturas')
              ->cascadeOnDelete();

        $table->primary(['curso_id', 'asignatura_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curso_asignaturas');
    }
};

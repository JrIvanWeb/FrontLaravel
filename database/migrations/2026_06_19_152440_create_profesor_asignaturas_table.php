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
    Schema::create('profesor_asignaturas', function (Blueprint $table) {

        $table->foreignId('profesor_id')
              ->constrained('profesores')
              ->cascadeOnDelete();

        $table->foreignId('asignatura_id')
              ->constrained('asignaturas')
              ->cascadeOnDelete();

        $table->primary(['profesor_id', 'asignatura_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesor_asignaturas');
    }
};

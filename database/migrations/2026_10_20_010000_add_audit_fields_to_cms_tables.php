<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $tables = [
        'Slider', 'Programas', 'CategoriaPrograma', 'Nosotros', 'Aliados',
        'Galeria', 'TipoGaleria', 'Equipo', 'Infos', 'Usuarios', 'Rol',
    ];

    public function up(): void
    {
        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table): void {
                $table->unsignedBigInteger('IdUsuarioCreacion')->nullable();
                $table->unsignedBigInteger('IdUsuarioEdicion')->nullable();
                $table->timestamp('FechaCreacion')->nullable();
                $table->timestamp('FechaActualizacion')->nullable();
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table): void {
                $table->dropColumn([
                    'IdUsuarioCreacion',
                    'IdUsuarioEdicion',
                    'FechaCreacion',
                    'FechaActualizacion',
                ]);
            });
        }
    }
};
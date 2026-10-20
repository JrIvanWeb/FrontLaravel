<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('TipoDocumento', function (Blueprint $table) {
            $table->id('Id');
            $table->string('Nombre')->unique();
            $table->unsignedBigInteger('IdUsuarioCreacion')->nullable();
            $table->unsignedBigInteger('IdUsuarioEdicion')->nullable();
            $table->timestamp('FechaCreacion')->nullable();
            $table->timestamp('FechaActualizacion')->nullable();
        });

        Schema::table('Usuarios', function (Blueprint $table) {
            $table->unsignedBigInteger('IdTipoDocumento')->nullable();
        });

        $legacyTypes = DB::table('Usuarios')
            ->whereNotNull('TipoDocumento')
            ->distinct()
            ->pluck('TipoDocumento');

        foreach ($legacyTypes as $legacyType) {
            $name = trim((string) $legacyType);
            if ($name === '') {
                continue;
            }

            DB::table('TipoDocumento')->insertOrIgnore(['Nombre' => $name]);
            $typeId = DB::table('TipoDocumento')->where('Nombre', $name)->value('Id');

            DB::table('Usuarios')
                ->where('TipoDocumento', $legacyType)
                ->update(['IdTipoDocumento' => $typeId]);
        }

        Schema::table('Usuarios', function (Blueprint $table) {
            $table->foreign('IdTipoDocumento')->references('Id')->on('TipoDocumento');
            $table->dropColumn('TipoDocumento');
        });
    }

    public function down(): void
    {
        Schema::table('Usuarios', function (Blueprint $table) {
            $table->string('TipoDocumento')->nullable();
        });

        $users = DB::table('Usuarios')
            ->join('TipoDocumento', 'Usuarios.IdTipoDocumento', '=', 'TipoDocumento.Id')
            ->select('Usuarios.Id', 'TipoDocumento.Nombre')
            ->get();

        foreach ($users as $user) {
            DB::table('Usuarios')->where('Id', $user->Id)->update([
                'TipoDocumento' => $user->Nombre,
            ]);
        }

        Schema::table('Usuarios', function (Blueprint $table) {
            $table->dropForeign(['IdTipoDocumento']);
            $table->dropColumn('IdTipoDocumento');
        });

        Schema::dropIfExists('TipoDocumento');
    }
};
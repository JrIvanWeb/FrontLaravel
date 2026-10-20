<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('CategoriaPrograma', function (Blueprint $table) {
            $table->id('Id');
            $table->string('Nombre');
            $table->boolean('Estado');
        });

        Schema::create('TipoGaleria', function (Blueprint $table) {
            $table->id('Id');
            $table->string('Nombre');
            $table->boolean('Estado');
        });

        Schema::create('Rol', function (Blueprint $table) {
            $table->id('Id');
            $table->string('Nombre');
        });

        Schema::create('Slider', function (Blueprint $table) {
            $table->id('Id');
            $table->string('Imagen');
            $table->string('Nombre');
            $table->text('Url');
            $table->boolean('Estado');
        });

        Schema::create('Programas', function (Blueprint $table) {
            $table->id('Id');
            $table->string('Nombre');
            $table->text('Descripcion');
            $table->unsignedSmallInteger('IntensidadHoraria');
            $table->string('Modalidad');
            $table->string('Imagen');
            $table->unsignedBigInteger('IdCategoriaPrograma');
            $table->boolean('Estado');
            $table->foreign('IdCategoriaPrograma')
                ->references('Id')->on('CategoriaPrograma');
        });

        Schema::create('Nosotros', function (Blueprint $table) {
            $table->id('Id');
            $table->text('QuienesSomos');
            $table->text('Mision');
            $table->text('Vision');
            $table->string('Imagen');
            $table->unsignedInteger('NumeroGraduados');
            $table->unsignedInteger('NumeroActivos');
            $table->unsignedSmallInteger('AniosTrayectoria');
            $table->unsignedInteger('NumeroEmpresas');
        });

        Schema::create('Aliados', function (Blueprint $table) {
            $table->id('Id');
            $table->string('Nombre');
            $table->string('Imagen');
            $table->boolean('Estado');
        });

        Schema::create('Galeria', function (Blueprint $table) {
            $table->id('Id');
            $table->string('Imagen');
            $table->unsignedBigInteger('IdTipoGaleria');
            $table->boolean('Estado');
            $table->foreign('IdTipoGaleria')
                ->references('Id')->on('TipoGaleria');
        });

        Schema::create('Equipo', function (Blueprint $table) {
            $table->id('Id');
            $table->string('Imagen');
            $table->string('Nombres');
            $table->string('Apellidos');
            $table->string('Cargo');
            $table->string('Whatsapp');
            $table->boolean('Estado');
        });

        Schema::create('Infos', function (Blueprint $table) {
            $table->id('Id');
            $table->string('Direccion');
            $table->string('CiudadDepartamento');
            $table->string('Telefono');
            $table->string('Whatsapp');
            $table->string('Correo');
            $table->string('Facebook');
            $table->string('Instagram');
            $table->string('Logo');
            $table->string('Youtube');
        });

        Schema::create('Usuarios', function (Blueprint $table) {
            $table->id('Id');
            $table->string('Nombres');
            $table->string('Apellidos');
            $table->string('Correo')->unique();
            $table->string('Telefono');
            $table->string('TipoDocumento');
            $table->string('Documento');
            $table->boolean('Estado');
            $table->unsignedBigInteger('IdRol');
            $table->string('Password');
            $table->foreign('IdRol')->references('Id')->on('Rol');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('Usuarios');
        Schema::dropIfExists('Infos');
        Schema::dropIfExists('Equipo');
        Schema::dropIfExists('Galeria');
        Schema::dropIfExists('Aliados');
        Schema::dropIfExists('Nosotros');
        Schema::dropIfExists('Programas');
        Schema::dropIfExists('Slider');
        Schema::dropIfExists('Rol');
        Schema::dropIfExists('TipoGaleria');
        Schema::dropIfExists('CategoriaPrograma');
    }
};
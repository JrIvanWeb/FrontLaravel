<?php

namespace App\Console\Commands;

use App\Models\Rol;
use App\Models\TipoDocumento;
use App\Models\Usuario;
use Illuminate\Console\Command;

class CreateAdminCommand extends Command
{
    protected $signature = 'back-ict:admin:create {--email=}';

    protected $description = 'Crear el primer usuario administrador de Back-ICT';

    public function handle(): int
    {
        $email = $this->option('email') ?: $this->ask('Correo del administrador');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('El correo no es válido.');

            return self::FAILURE;
        }

        if (Usuario::query()->where('Correo', $email)->exists()) {
            $this->error('Ya existe un usuario con ese correo.');

            return self::FAILURE;
        }

        $password = $this->secret('Contraseña (mínimo 12 caracteres)');
        $confirmation = $this->secret('Confirma la contraseña');

        if (strlen($password) < 12 || !hash_equals($password, $confirmation)) {
            $this->error('La contraseña debe tener al menos 12 caracteres y coincidir con la confirmación.');

            return self::FAILURE;
        }

        $adminRole = Rol::query()->firstOrCreate(['Nombre' => 'Admin']);
        $documentType = TipoDocumento::query()->firstOrCreate([
            'Nombre' => $this->ask('Tipo de documento'),
        ]);

        Usuario::query()->create([
            'Nombres' => $this->ask('Nombres'),
            'Apellidos' => $this->ask('Apellidos'),
            'Correo' => $email,
            'Telefono' => $this->ask('Teléfono'),
            'IdTipoDocumento' => $documentType->getKey(),
            'Documento' => $this->ask('Número de documento'),
            'Estado' => true,
            'IdRol' => $adminRole->getKey(),
            'Password' => $password,
        ]);

        $this->info('Administrador creado correctamente.');

        return self::SUCCESS;
    }
}
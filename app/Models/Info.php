<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Info extends Auditoria
{
    protected $table = 'Infos';
    protected $primaryKey = 'Id';
    protected $fillable = [
        'Direccion', 'CiudadDepartamento', 'Telefono', 'Whatsapp', 'Correo',
        'Facebook', 'Instagram', 'Logo', 'Youtube',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Usuario extends Auditoria implements AuthenticatableContract
{
    use HasApiTokens, Authenticatable, HasFactory, Notifiable;

    protected $table = 'Usuarios';
    protected $primaryKey = 'Id';
    protected $with = ['rol', 'tipoDocumento'];
    protected $fillable = [
        'Nombres', 'Apellidos', 'Correo', 'Telefono', 'IdTipoDocumento',
        'Documento', 'Estado', 'IdRol', 'Password',
    ];
    protected $hidden = ['Password'];
    protected $casts = ['Estado' => 'boolean', 'Password' => 'hashed'];

    public function getAuthPasswordName(): string
    {
        return 'Password';
    }

    public function getEmailForPasswordReset(): string
    {
        return $this->Correo;
    }

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'IdRol', 'Id');
    }

    public function tipoDocumento(): BelongsTo
    {
        return $this->belongsTo(TipoDocumento::class, 'IdTipoDocumento', 'Id');
    }
}
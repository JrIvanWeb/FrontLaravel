<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

abstract class Auditoria extends Model
{
    public const CREATED_AT = 'FechaCreacion';
    public const UPDATED_AT = 'FechaActualizacion';

    protected static function booted(): void
    {
        static::creating(function (Model $model): void {
            if (Auth::id() !== null) {
                $model->setAttribute('IdUsuarioCreacion', Auth::id());
            }
        });

        static::updating(function (Model $model): void {
            if (Auth::id() !== null) {
                $model->setAttribute('IdUsuarioEdicion', Auth::id());
            }
        });
    }

    public function usuarioCreacion(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'IdUsuarioCreacion', 'Id');
    }

    public function usuarioEdicion(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'IdUsuarioEdicion', 'Id');
    }
}
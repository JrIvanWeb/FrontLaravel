<?php

namespace App\Http\Middleware;

use App\Exceptions\InsufficientRoleException;
use Closure;
use Illuminate\Http\Request;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        $user = $request->user();

        if (!$user || !$user->Estado || !in_array($user->rol?->Nombre, $roles, true)) {
            throw new InsufficientRoleException();
        }

        return $next($request);
    }
}
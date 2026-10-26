<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class RefreshSanctumTokenExpiration
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->user()?->currentAccessToken();

        if ($token instanceof PersonalAccessToken) {
            $token->forceFill([
                'expires_at' => now()->addMinutes((int) config('session.lifetime')),
            ])->save();
        }

        return $next($request);
    }
}

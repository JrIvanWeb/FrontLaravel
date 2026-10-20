<?php

namespace App\Services;

use App\Exceptions\InvalidPasswordResetCodeException;
use App\Exceptions\PasswordResetRateLimitException;
use App\Interfaces\IPasswordResetService;
use App\Mail\PasswordResetCodeMail;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Carbon;
use Throwable;

class PasswordResetService implements IPasswordResetService
{
    public function sendCode(string $email): void
    {
        $normalizedEmail = mb_strtolower(trim($email));
        $this->limitAttempts('send', $normalizedEmail, 3);

        $user = Usuario::query()
            ->whereRaw('LOWER(Correo) = ?', [$normalizedEmail])
            ->where('Estado', true)
            ->first();

        if (!$user) {
            return;
        }

        $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $normalizedEmail],
            [
                'token' => Hash::make($code),
                'created_at' => now(),
            ]
        );

        try {
            Mail::to($user->Correo)->send(new PasswordResetCodeMail(
                $code,
                (int) config('auth.passwords.users.code_expire', 10)
            ));
        } catch (Throwable $exception) {
            DB::table('password_reset_tokens')->where('email', $normalizedEmail)->delete();
            report($exception);
        }
    }

    public function resetPassword(string $email, string $code, string $password): void
    {
        $normalizedEmail = mb_strtolower(trim($email));
        $rateLimitKey = $this->limitAttempts('verify', $normalizedEmail, 5);

        DB::transaction(function () use ($normalizedEmail, $code, $password): void {
            $reset = DB::table('password_reset_tokens')
                ->where('email', $normalizedEmail)
                ->lockForUpdate()
                ->first();

            $expiresAt = config('auth.passwords.users.code_expire', 10);
            $expired = !$reset
                || !$reset->created_at
                || now()->greaterThan(Carbon::parse($reset->created_at)->addMinutes($expiresAt));

            if ($expired) {
                throw new InvalidPasswordResetCodeException();
            }

            if (!Hash::check($code, $reset->token)) {
                throw new InvalidPasswordResetCodeException();
            }

            $user = Usuario::query()
                ->whereRaw('LOWER(Correo) = ?', [$normalizedEmail])
                ->where('Estado', true)
                ->first();

            if (!$user) {
                throw new InvalidPasswordResetCodeException();
            }

            $user->forceFill(['Password' => $password])->save();
            $user->tokens()->delete();

            DB::table('password_reset_tokens')->where('email', $normalizedEmail)->delete();
        });

        RateLimiter::clear($rateLimitKey);
    }

    private function limitAttempts(string $action, string $email, int $maxAttempts): string
    {
        $key = 'password-reset:'.$action.':'.hash('sha256', mb_strtolower(trim($email)));

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            throw new PasswordResetRateLimitException();
        }

        RateLimiter::hit($key, 600);

        return $key;
    }
}
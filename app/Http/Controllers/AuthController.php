<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidCredentialsException;
use App\Interfaces\IPasswordResetService;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function __construct(private readonly IPasswordResetService $passwordResetService)
    {
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'Correo' => ['required', 'email'],
            'Password' => ['required', 'string'],
        ]);

        $user = Usuario::query()
            ->where('Correo', $credentials['Correo'])
            ->where('Estado', true)
            ->first();

        if (!$user || !Hash::check($credentials['Password'], $user->Password)) {
            throw new InvalidCredentialsException();
        }

        return response()->json([
            'token' => $user->createToken('back-ict-admin')->plainTextToken,
            'token_type' => 'Bearer',
            'usuario' => $user->load('rol'),
        ]);
    }

    public function me(Request $request)
    {
        return $request->user()->load('rol');
    }

    public function forgotPassword(Request $request)
    {
        $data = $request->validate([
            'Correo' => ['required', 'email', 'max:255'],
        ]);

        $this->passwordResetService->sendCode($data['Correo']);

        return response()->json([
            'message' => 'Si el correo está registrado, recibirás un código de recuperación.',
        ], 202);
    }

    public function resetPassword(Request $request)
    {
        $data = $request->validate([
            'Correo' => ['required', 'email', 'max:255'],
            'Codigo' => ['required', 'string', 'regex:/^\d{6}$/'],
            'Password' => ['required', 'confirmed', PasswordRule::min(12)],
        ]);

        $this->passwordResetService->resetPassword(
            $data['Correo'],
            $data['Codigo'],
            $data['Password']
        );

        return response()->json(['message' => 'La contraseña se actualizó correctamente.']);
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken()
            ? PersonalAccessToken::findToken($request->bearerToken())
            : null;

        if ($token && $token->tokenable->is($request->user())) {
            $token->delete();
        }

        return response()->noContent();
    }
}
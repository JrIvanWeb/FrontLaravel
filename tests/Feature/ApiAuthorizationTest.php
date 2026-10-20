<?php

namespace Tests\Feature;

use App\Models\Rol;
use App\Models\TipoDocumento;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_get_profile_and_revoke_token(): void
    {
        $user = $this->createUser('Admin', 'admin@example.com');

        $response = $this->postJson('/api/auth/login', [
            'Correo' => $user->Correo,
            'Password' => 'BackIct-password-123',
        ]);

        $response->assertOk()
            ->assertJsonPath('token_type', 'Bearer')
            ->assertJsonPath('usuario.Correo', $user->Correo)
            ->assertJsonMissingPath('usuario.Password');

        $token = $response->json('token');

        $this->withToken($token)
            ->getJson('/api/auth/me')
            ->assertOk()
            ->assertJsonPath('Correo', $user->Correo);

        $this->withToken($token)->deleteJson('/api/auth/logout')->assertNoContent();
        $this->assertDatabaseCount('personal_access_tokens', 0);
        Auth::forgetGuards();
        $this->withToken($token)->getJson('/api/auth/me')->assertUnauthorized();
    }

    public function test_guest_can_read_content_but_cannot_manage_it_or_users(): void
    {
        $this->getJson('/api/sliders')->assertOk();
        $this->postJson('/api/aliados')->assertUnauthorized();
        $this->getJson('/api/usuarios')->assertUnauthorized();
    }

    public function test_editor_can_manage_content_but_not_users_or_roles(): void
    {
        Sanctum::actingAs($this->createUser('Editor', 'editor@example.com'));

        $this->postJson('/api/aliados')->assertUnprocessable();
        $this->getJson('/api/usuarios')->assertForbidden();
        $this->getJson('/api/roles')->assertForbidden();
    }

    public function test_admin_can_access_users_and_roles(): void
    {
        Sanctum::actingAs($this->createUser('Admin', 'admin@example.com'));

        $this->getJson('/api/usuarios')->assertOk();
        $this->getJson('/api/roles')->assertOk();
    }

    private function createUser(string $roleName, string $email): Usuario
    {
        $role = Rol::query()->firstOrCreate(['Nombre' => $roleName]);
        $documentType = TipoDocumento::query()->firstOrCreate(['Nombre' => 'CC']);

        return Usuario::query()->create([
            'Nombres' => 'Test',
            'Apellidos' => 'User',
            'Correo' => $email,
            'Telefono' => '3001234567',
            'IdTipoDocumento' => $documentType->getKey(),
            'Documento' => uniqid(),
            'Estado' => true,
            'IdRol' => $role->getKey(),
            'Password' => 'BackIct-password-123',
        ]);
    }
}
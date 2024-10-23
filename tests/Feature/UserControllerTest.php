<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_cambiar_contraseña_funciona_correctamente()
    {
        // Crea un usuario de prueba
        $user = User::factory()->create([
            'password' => bcrypt('password_original')
        ]);

        // Inicia sesión con ese usuario
        $this->actingAs($user);

        // Realiza la solicitud para cambiar la contraseña
        $response = $this->post('/users/update-password', [
            'current_password' => 'password_original',
            'new_password' => 'password_nueva',
            'new_password_confirmation' => 'password_nueva',
        ]);

        // Verifica que la contraseña ha sido actualizada correctamente
        $this->assertTrue(Hash::check('password_nueva', $user->fresh()->password));
    }
}

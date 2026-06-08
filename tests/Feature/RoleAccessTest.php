<?php

namespace Tests\Feature;

use App\Models\Perfil;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Perfil::query()->insert([
            ['id' => 1, 'nombre' => 'Admin'],
            ['id' => 2, 'nombre' => 'Empleado'],
        ]);
    }

    public function test_admin_can_access_management_forms(): void
    {
        $admin = User::factory()->create(['idperfil' => 1]);

        $this->actingAs($admin)->get(route('clientes.create'))->assertOk();
        $this->actingAs($admin)->get(route('perfiles.create'))->assertOk();
        $this->actingAs($admin)->get(route('facturas.create'))->assertOk();
    }

    public function test_employee_can_view_tables_but_cannot_access_management_forms(): void
    {
        $employee = User::factory()->create(['idperfil' => 2]);

        $this->actingAs($employee)->get(route('clientes.index'))->assertOk();
        $this->actingAs($employee)->get(route('perfiles.index'))->assertOk();
        $this->actingAs($employee)->get(route('facturas.index'))->assertOk();

        $this->actingAs($employee)->get(route('clientes.create'))->assertRedirect(route('facturas.index'));
        $this->actingAs($employee)->get(route('perfiles.create'))->assertRedirect(route('facturas.index'));
        $this->actingAs($employee)->get(route('facturas.create'))->assertRedirect(route('facturas.index'));
    }
}

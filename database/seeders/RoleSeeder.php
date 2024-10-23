<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Crear rol de administrador
    Role::create(['name' => 'admin']);
    
    // Crear rol de usuario
    Role::create(['name' => 'user']);
    
    }
}

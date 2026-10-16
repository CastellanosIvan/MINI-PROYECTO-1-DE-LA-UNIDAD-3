<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Gerente CazFixt',
            'email' => 'gerente@cazfixt.test',
            'phone' => '9141000001',
            'password' => 'Password123',
            'role' => User::ROLE_GERENTE,
        ]);

        User::create([
            'name' => 'Empleado CazFixt',
            'email' => 'empleado@cazfixt.test',
            'phone' => '9141000002',
            'password' => 'Password123',
            'role' => User::ROLE_EMPLEADO,
        ]);

        User::create([
            'name' => 'Cliente Demo',
            'email' => 'cliente@cazfixt.test',
            'phone' => '9141000003',
            'password' => 'Password123',
            'role' => User::ROLE_CLIENTE,
        ]);
    }
}

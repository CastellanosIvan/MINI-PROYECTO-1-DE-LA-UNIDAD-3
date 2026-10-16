<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    // Redirige según el rol del usuario autenticado
    public function index()
    {
        return match (auth()->user()->role) {
            User::ROLE_GERENTE => redirect()->route('dashboard.gerente'),
            User::ROLE_EMPLEADO => redirect()->route('dashboard.empleado'),
            default => redirect()->route('dashboard.cliente'),
        };
    }

    public function cliente()
    {
        return view('dashboard.cliente');
    }

    public function empleado()
    {
        return view('dashboard.empleado');
    }

    public function gerente()
    {
        return view('dashboard.gerente', [
            'totalUsuarios' => User::count(),
            'totalClientes' => User::where('role', User::ROLE_CLIENTE)->count(),
            'totalEmpleados' => User::where('role', User::ROLE_EMPLEADO)->count(),
        ]);
    }
}

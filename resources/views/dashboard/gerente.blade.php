@extends('layouts.app')
@section('title', 'Panel del gerente')
@section('content')
<div class="card"><h1>Panel de administración</h1><p>{{ auth()->user()->name }} — <span class="badge">Gerente</span></p></div>
<div class="grid">
    <div class="card"><h3>👥 Usuarios</h3><p>Total: <strong>{{ $totalUsuarios }}</strong></p>
        <p>Clientes: {{ $totalClientes }} · Empleados: {{ $totalEmpleados }}</p>
        <a class="btn" href="{{ route('usuarios.index') }}">Administrar usuarios</a></div>
    <div class="card"><h3>📊 Reportes</h3><p>Próximamente.</p></div>
    <div class="card"><h3>⚙️ Configuración</h3><p>Próximamente.</p></div>
</div>
@endsection

@extends('layouts.app')
@section('title', 'Panel del cliente')
@section('content')
<div class="card"><h1>Hola, {{ auth()->user()->name }} 👋</h1><p>Panel del <span class="badge">Cliente</span></p></div>
<div class="grid">
    <div class="card"><h3>🛠️ Solicitar reparación</h3><p>Próximamente.</p></div>
    <div class="card"><h3>📋 Mis reparaciones</h3><p>Consulta el estado de tus equipos. Próximamente.</p></div>
    <div class="card"><h3>🛒 Tienda</h3><p>Accesorios y refacciones. Próximamente.</p></div>
    <div class="card"><h3>👤 Mi perfil</h3><p>{{ auth()->user()->email }}</p></div>
</div>
@endsection

@extends('layouts.app')
@section('title', 'Usuarios')
@section('content')
<div class="card">
    <div class="row" style="justify-content:space-between">
        <h1 style="margin:0">Usuarios</h1>
        <a class="btn" href="{{ route('usuarios.create') }}">+ Nuevo usuario</a>
    </div>

    <form method="GET" action="{{ route('usuarios.index') }}" class="row" style="margin:16px 0">
        <div style="flex:2"><label>Buscar</label>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Nombre o correo"></div>
        <div style="flex:1"><label>Rol</label>
            <select name="role">
                <option value="">Todos</option>
                @foreach ($roles as $r)
                    <option value="{{ $r }}" @selected(request('role') === $r)>{{ ucfirst($r) }}</option>
                @endforeach
            </select></div>
        <button class="btn" type="submit">Filtrar</button>
        <a class="btn btn-gray" href="{{ route('usuarios.index') }}">Limpiar</a>
    </form>

    <div style="overflow-x:auto">
    <table>
        <thead>
            <tr><th>#</th><th>Nombre</th><th>Correo</th><th>Teléfono</th><th>Rol</th><th>Registro</th><th>Acciones</th></tr>
        </thead>
        <tbody>
        @forelse ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone ?? '—' }}</td>
                <td><span class="badge">{{ ucfirst($user->role) }}</span></td>
                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                <td>
                    <a class="btn" href="{{ route('usuarios.edit', $user) }}">Editar</a>
                    @if ($user->id !== auth()->id())
                    <form class="inline" method="POST" action="{{ route('usuarios.destroy', $user) }}"
                          onsubmit="return confirm('¿Eliminar a {{ $user->name }}?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-red" type="submit">Eliminar</button>
                    </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="7" style="text-align:center">No se encontraron usuarios.</td></tr>
        @endforelse
        </tbody>
    </table>
    </div>

    <div class="pagination">{{ $users->links() }}</div>
</div>
@endsection

@extends('layouts.app')
@section('title', 'Editar usuario')
@section('content')
<div class="card narrow">
    <h2>Editar usuario</h2>
    <form method="POST" action="{{ route('usuarios.update', $user) }}" novalidate>
        @method('PUT')
        @include('users._form')
    </form>
</div>
@endsection

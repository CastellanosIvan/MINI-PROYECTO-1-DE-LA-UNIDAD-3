@extends('layouts.app')
@section('title', 'Nuevo usuario')
@section('content')
<div class="card narrow">
    <h2>Nuevo usuario</h2>
    <form method="POST" action="{{ route('usuarios.store') }}" novalidate>
        @include('users._form')
    </form>
</div>
@endsection

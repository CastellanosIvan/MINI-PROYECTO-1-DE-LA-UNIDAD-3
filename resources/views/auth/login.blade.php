@extends('layouts.app')
@section('title', 'Iniciar sesión')
@section('content')
<div class="card narrow">
    <h2>Iniciar sesión</h2>
    <form method="POST" action="{{ route('login.store') }}" novalidate>
        @csrf
        <label for="email">Correo electrónico</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>
        @error('password') <div class="error">{{ $message }}</div> @enderror

        <label style="font-weight:normal"><input type="checkbox" name="remember" style="width:auto"> Recordarme</label>

        <br><button class="btn" type="submit">Entrar</button>
        <p>¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
    </form>
</div>
@endsection

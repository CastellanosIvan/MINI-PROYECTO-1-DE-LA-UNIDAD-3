@extends('layouts.app')
@section('title', 'Registro')
@section('content')
<div class="card narrow">
    <h2>Crear cuenta</h2>
    <form method="POST" action="{{ route('register.store') }}" novalidate>
        @csrf
        <label for="name">Nombre completo</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        @error('name') <div class="error">{{ $message }}</div> @enderror

        <label for="email">Correo electrónico</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label for="phone">Teléfono (10 dígitos, opcional)</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" maxlength="10">
        @error('phone') <div class="error">{{ $message }}</div> @enderror

        <label for="password">Contraseña (mín. 8, letras y números)</label>
        <input type="password" id="password" name="password" required>
        @error('password') <div class="error">{{ $message }}</div> @enderror

        <label for="password_confirmation">Confirmar contraseña</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        <br><button class="btn" type="submit">Registrarme</button>
        <p>¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
    </form>
</div>
@endsection

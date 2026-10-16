@extends('layouts.app')
@section('title', 'Contáctanos')
@section('content')
<div class="card">
    <h1>Contáctanos</h1>
    <p>📞 Teléfono / WhatsApp: 961 192 4644</p>
    <p>✉️ Correo: cazivannunez@gmail.com</p>
    <p>📍 Visítanos en nuestra sucursal (ver <a href="{{ route('ubicacion') }}">Ubicación</a>).</p>
</div>
@endsection

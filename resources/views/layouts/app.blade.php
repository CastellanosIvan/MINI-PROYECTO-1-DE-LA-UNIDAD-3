<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CazFixt') | CazFixt</title>
    <style>
        /* ====== MODO OSCURO GLOBAL ====== */
        :root { 
            --fondo: #000000; 
            --fondo-tarjeta: #111111; 
            --borde: #222222; 
            --borde-tarjeta: #333333; 
            --txt: #ffffff; 
            --txt-secundario: #aaaaaa; 
            --azul2: #1565c0; 
            --rojo: #c62828; 
            --verde: #2e7d32; 
        }
        * { box-sizing:border-box; }
        body { margin:0; font-family:Segoe UI, Arial, sans-serif; background:var(--fondo); color:var(--txt); }
        
        /* BARRA DE NAVEGACIÓN NEGRA */
        nav { background:var(--fondo); color:#fff; display:flex; flex-wrap:wrap; align-items:center; gap:10px; padding:15px 24px; border-bottom: 1px solid var(--borde); }
        
        /* CONFIGURACIÓN DEL LOGO (Sin borde azul) */
        nav .brand { margin-right:auto; padding: 0 !important; display: flex; align-items: center; }
        nav .brand:hover { background: transparent !important; }
        
        /* ENLACES DEL MENÚ */
        nav a, nav button { color:#fff; text-decoration:none; padding:8px 12px; border-radius:6px; background:none; border:0; font-size:1rem; cursor:pointer; transition: background 0.2s; }
        nav a:hover, nav button:hover { background: #222; }
        
        /* CONTENEDOR PRINCIPAL LIMITADO (Para que los formularios no se estiren feo) */
        main { max-width:1000px; margin:28px auto; padding:0 20px; }
        
        /* TARJETAS OSCURAS (Para formularios, dashboards, etc) */
        .card { background:var(--fondo-tarjeta); border: 1px solid var(--borde-tarjeta); border-radius:10px; padding:24px; box-shadow:none; margin-bottom:20px; }
        .card h1, .card h2, .card h3 { margin-top: 0; color: #fff; }
        .card p { color: var(--txt-secundario); }
        
        .grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:16px; }
        .btn { display:inline-block; background:var(--azul2); color:#fff; padding:9px 16px; border-radius:6px; border:0; text-decoration:none; cursor:pointer; font-size:.95rem; font-weight: bold; }
        .btn:hover { background: #0b3d91; }
        .btn-red { background:var(--rojo); } 
        .btn-gray { background:#333; color: white; border: 1px solid #555; }
        .btn-gray:hover { background: #444; }
        
        /* FORMULARIOS MODO OSCURO */
        label { display:block; margin:14px 0 4px; font-weight:600; color: #ccc; }
        input, select { width:100%; padding:10px; border:1px solid #444; border-radius:6px; font-size:1rem; background: #000; color: #fff; }
        input:focus, select:focus { outline: none; border-color: var(--azul2); }
        .error { color:#ff6b6b; font-size:.88rem; margin-top:4px; }
        
        /* ALERTAS */
        .alert { padding:12px 16px; border-radius:6px; margin-bottom:16px; }
        .alert-ok { background:#0a2a16; color:#a3cfbb; border: 1px solid var(--verde); } 
        .alert-err { background:#3b0a0a; color:#ea868f; border: 1px solid var(--rojo); }
        
        /* TABLAS MODO OSCURO (Para el panel de usuarios) */
        table { width:100%; border-collapse:collapse; } 
        th, td { padding:12px 10px; text-align:left; border-bottom:1px solid #333; }
        th { background:#1a1a1a; color: #ccc; } 
        .badge { padding:4px 10px; border-radius:12px; font-size:.8rem; background:#222; color:#fff; border: 1px solid #444; }
        
        .inline { display:inline; } .row { display:flex; gap:10px; flex-wrap:wrap; align-items:end; }
        .narrow { max-width:460px; margin:auto; } 
        footer { text-align:center; padding:20px; color:#555; font-size:.9rem; border-top: 1px solid #222; margin-top: 40px; }
        .pagination { margin-top:16px; }
    </style>
</head>
<body>
<nav>
    <!-- Tu logo aquí (con alto corregido y sin borde) -->
    <a class="brand" href="{{ route('home') }}">
        <img src="{{ asset('img/logo.png') }}" alt="Logo CazFixt" style="height: 35px; vertical-align: middle;">
    </a>

    <a href="{{ route('home') }}">Inicio</a>
    <a href="{{ route('quienes-somos') }}">Quiénes somos</a>
    <a href="{{ route('mision-vision') }}">Misión y visión</a>
    <a href="{{ route('ubicacion') }}">Ubicación</a>
    <a href="{{ route('contacto') }}">Contáctanos</a>

    @guest
        <a href="{{ route('login') }}">Iniciar sesión</a>
        <a href="{{ route('register') }}">Registrarse</a>
    @endguest

    @auth
        <a href="{{ route('dashboard') }}">Mi panel</a>
        <form class="inline" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Cerrar sesión ({{ auth()->user()->name }})</button>
        </form>
    @endauth
</nav>

<main>
    @if (session('success')) <div class="alert alert-ok">{{ session('success') }}</div> @endif
    @if (session('error'))   <div class="alert alert-err">{{ session('error') }}</div> @endif
    @yield('content')
</main>

<footer>© {{ date('Y') }} CazFixt — Reparación de dispositivos móviles</footer>
</body>
</html>
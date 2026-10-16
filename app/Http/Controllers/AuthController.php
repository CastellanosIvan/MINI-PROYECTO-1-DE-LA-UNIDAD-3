<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /* ---------- LOGIN ---------- */

    public function showLogin()
    {
        return view('auth.login');
    }

    // Código de verificación del inicio de sesión
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Ingresa un correo válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate(); // evita fijación de sesión

            return redirect()->intended(route('dashboard'));
        }

        return back()
            ->withErrors(['email' => 'Las credenciales no coinciden con nuestros registros.'])
            ->onlyInput('email');
    }

    /* ---------- REGISTRO ---------- */

    public function showRegister()
    {
        return view('auth.register');
    }

    // Código de registro de usuarios + validación de datos
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'digits:10'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Ingresa un correo válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'phone.digits' => 'El teléfono debe tener 10 dígitos.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        // El registro público SIEMPRE crea clientes; el rol no viene del formulario.
        $user = User::create($data + ['role' => User::ROLE_CLIENTE]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard')
            ->with('success', '¡Bienvenido a CazFixt, '.$user->name.'!');
    }

    /* ---------- LOGOUT ---------- */

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Sesión cerrada correctamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    // Código para LISTAR usuarios (con búsqueda y filtro por rol)
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $q = $request->q;
                $query->where(fn ($w) => $w->where('name', 'like', "%{$q}%")
                                           ->orWhere('email', 'like', "%{$q}%"));
            })
            ->when($request->filled('role'), fn ($query) => $query->where('role', $request->role))
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('users.index', ['users' => $users, 'roles' => User::ROLES]);
    }

    public function create()
    {
        return view('users.create', ['roles' => User::ROLES]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'digits:10'],
            'role' => ['required', Rule::in(User::ROLES)],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        User::create($data);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user, 'roles' => User::ROLES]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => ['nullable', 'digits:10'],
            'role' => ['required', Rule::in(User::ROLES)],
            'password' => ['nullable', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        // Si no escribió contraseña nueva, se conserva la actual
        if (empty($data['password'])) {
            unset($data['password']);
        }

        // Evita que el gerente se quite su propio rol y se quede sin acceso
        if ($user->id === auth()->id()) {
            $data['role'] = $user->role;
        }

        $user->update($data);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminar tu propia cuenta.');
        }

        $user->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}

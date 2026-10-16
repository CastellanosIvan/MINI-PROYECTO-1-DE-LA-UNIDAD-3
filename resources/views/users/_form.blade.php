@csrf
<label for="name">Nombre completo</label>
<input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required>
@error('name') <div class="error">{{ $message }}</div> @enderror

<label for="email">Correo electrónico</label>
<input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
@error('email') <div class="error">{{ $message }}</div> @enderror

<label for="phone">Teléfono (10 dígitos)</label>
<input type="text" id="phone" name="phone" maxlength="10" value="{{ old('phone', $user->phone ?? '') }}">
@error('phone') <div class="error">{{ $message }}</div> @enderror

<label for="role">Rol</label>
<select id="role" name="role" required>
    @foreach ($roles as $r)
        <option value="{{ $r }}" @selected(old('role', $user->role ?? 'cliente') === $r)>{{ ucfirst($r) }}</option>
    @endforeach
</select>
@error('role') <div class="error">{{ $message }}</div> @enderror

<label for="password">Contraseña {{ isset($user) ? '(déjala vacía para no cambiarla)' : '' }}</label>
<input type="password" id="password" name="password" {{ isset($user) ? '' : 'required' }}>
@error('password') <div class="error">{{ $message }}</div> @enderror

<label for="password_confirmation">Confirmar contraseña</label>
<input type="password" id="password_confirmation" name="password_confirmation">

<br>
<button class="btn" type="submit">Guardar</button>
<a class="btn btn-gray" href="{{ route('usuarios.index') }}">Cancelar</a>

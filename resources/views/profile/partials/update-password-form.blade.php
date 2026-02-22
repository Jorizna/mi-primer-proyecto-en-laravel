<div class="card">
    <h3 style="margin:0 0 .25rem;">Cambiar contraseña</h3>
    <p style="color:#6b7280;font-size:.9rem;margin:0 0 1.5rem;">Usa una contraseña larga y segura.</p>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="form-group">
            <label class="form-label" for="current_password">Contraseña actual</label>
            <input type="password" id="current_password" name="current_password"
                   class="form-control" autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="new_password">Nueva contraseña</label>
            <input type="password" id="new_password" name="password"
                   class="form-control" autocomplete="new-password">
            @error('password', 'updatePassword')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                   class="form-control" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        @if (session('status') === 'password-updated')
            <span style="color:#065f46;font-size:.875rem;margin-left:.75rem;">Guardado.</span>
        @endif
    </form>
</div>

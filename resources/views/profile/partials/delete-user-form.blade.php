<div class="card" x-data="{ open: false }">
    <h3 style="margin:0 0 .25rem;">Eliminar cuenta</h3>
    <p style="color:#6b7280;font-size:.9rem;margin:0 0 1.5rem;">
        Una vez eliminada tu cuenta, todos tus datos se borrarán permanentemente.
    </p>

    <button class="btn btn-danger" @click="open = true">Eliminar cuenta</button>

    <div x-show="open" @keydown.escape.window="open = false" style="display:none;">
        <div style="position:fixed;inset:0;z-index:500;background:rgba(0,0,0,.5);display:flex;align-items:center;justify-content:center;padding:1rem;">
            <div class="card" style="max-width:420px;width:100%;margin:0;">
                <h3 style="margin:0 0 .5rem;">¿Seguro que quieres eliminar tu cuenta?</h3>
                <p style="color:#6b7280;font-size:.9rem;margin:0 0 1.25rem;">
                    Esta acción es irreversible. Introduce tu contraseña para confirmar.
                </p>

                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="form-group">
                        <label class="form-label" for="delete_password">Contraseña</label>
                        <input type="password" id="delete_password" name="password"
                               class="form-control" placeholder="••••••••">
                        @error('password', 'userDeletion')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div style="display:flex;gap:.75rem;justify-content:flex-end;">
                        <button type="button" class="btn btn-secondary" @click="open = false">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar cuenta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

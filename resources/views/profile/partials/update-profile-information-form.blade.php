<div class="card">
    <h3 style="margin:0 0 .25rem;">Información del perfil</h3>
    <p style="color:#6b7280;font-size:.9rem;margin:0 0 1.5rem;">Actualiza tu nombre y correo electrónico.</p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="form-group">
            <label class="form-label" for="name">Nombre</label>
            <input type="text" id="name" name="name" class="form-control"
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" class="form-control"
                   value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')<span class="form-error">{{ $message }}</span>@enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <p style="margin-top:.5rem;font-size:.875rem;color:#6b7280;">
                    Tu correo no está verificado.
                    <button form="send-verification" style="background:none;border:none;color:#4f46e5;cursor:pointer;font-size:inherit;padding:0;text-decoration:underline;">
                        Reenviar verificación
                    </button>
                </p>
                @if (session('status') === 'verification-link-sent')
                    <p style="color:#065f46;font-size:.875rem;margin-top:.25rem;">Se envió un nuevo enlace de verificación.</p>
                @endif
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        @if (session('status') === 'profile-updated')
            <span style="color:#065f46;font-size:.875rem;margin-left:.75rem;">Guardado.</span>
        @endif
    </form>
</div>

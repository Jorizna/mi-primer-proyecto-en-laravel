<x-guest-layout>
    <h2 class="auth-title">Iniciar sesión</h2>
    <p class="auth-subtitle">Accede a tu cuenta para continuar</p>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <div class="form-group">
            <label class="form-label" for="email">Correo electrónico</label>
            <input
                id="email"
                class="form-control"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="tu@email.com"
            />
            @error('email')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Contraseña</label>
            <input
                id="password"
                class="form-control"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="••••••••"
            />
            @error('password')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-remember">
            <label class="auth-remember-label">
                <input type="checkbox" name="remember" style="accent-color:#111827;">
                Recuérdame
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="auth-link">¿Olvidaste tu contraseña?</a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary auth-submit">Entrar</button>

        <p class="auth-divider">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="auth-link">Regístrate gratis</a>
        </p>
    </form>
</x-guest-layout>

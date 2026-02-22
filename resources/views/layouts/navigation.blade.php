<nav class="app-nav" x-data="{ open: false }">
    <div class="nav-container">

        <a href="{{ route('home') }}" class="nav-brand">&#127916; MovieApp</a>

        <div class="nav-links">
            <a href="{{ route('home') }}"
               class="nav-link {{ request()->routeIs('home') ? 'nav-link-active' : '' }}">Inicio</a>
            <a href="{{ route('movies.index') }}"
               class="nav-link {{ request()->routeIs('movies.index') ? 'nav-link-active' : '' }}">Películas</a>
            @auth
                <a href="{{ route('movies.mine') }}"
                   class="nav-link {{ request()->routeIs('movies.mine') ? 'nav-link-active' : '' }}">Mis películas</a>
            @endauth
        </div>

        <div class="nav-user">
            @auth
                <a href="{{ route('movies.create') }}" class="btn btn-primary btn-sm">+ Nueva</a>

                <div class="nav-dropdown" x-data="{ open: false }">
                    <button class="nav-user-btn" @click="open = !open">
                        {{ Auth::user()->name }} &#9660;
                    </button>
                    <div class="nav-dropdown-menu" x-show="open" @click.away="open = false" style="display:none;">
                        <a href="{{ route('profile.edit') }}" class="nav-dropdown-item">Mi perfil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-dropdown-item">Cerrar sesión</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="nav-link">Entrar</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Registrarse</a>
                @endif
            @endauth
        </div>

        <button class="nav-hamburger" @click="open = !open" aria-label="Abrir menú">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <!-- Menú móvil -->
    <div class="nav-mobile" x-show="open" style="display:none;">
        <a href="{{ route('home') }}" class="nav-mobile-link">Inicio</a>
        <a href="{{ route('movies.index') }}" class="nav-mobile-link">Películas</a>
        @auth
            <a href="{{ route('movies.mine') }}" class="nav-mobile-link">Mis películas</a>
            <a href="{{ route('movies.create') }}" class="nav-mobile-link">+ Nueva película</a>
            <a href="{{ route('profile.edit') }}" class="nav-mobile-link">Mi perfil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-mobile-link">Cerrar sesión</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="nav-mobile-link">Iniciar sesión</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="nav-mobile-link">Registrarse</a>
            @endif
        @endauth
    </div>
</nav>

<nav id="navmenu" class="navmenu">
    <ul x-data>
        <li>
            @if(Route::currentRouteName() == 'web.index')
                <a href="#hero" class="active">Inicio</a>
            @else
                <a href="{{ route('web.index') }}">Inicio</a>
            @endif
        </li>
        <li><a href="#about">Sobre la doctora</a></li>
        <li><a href="#doctors">Especialista</a></li>
        @guest
            <li><a href="{{ route('login') }}" @click="mostrarPreloader()">{{ __('Login') }}</a></li>
            @if(Route::has('register'))
                <li><a href="{{ route('register') }}" @click="mostrarPreloader()">{{ __('Register') }}</a></li>
            @endif
            <li><a href="#" class="d-md-none" @click.prevent="mostrarAlertAuth()">Agendar cita</a></li>
        @else
            <li class="dropdown">
                <a href="#" @click.prevent="$root.querySelector('#btn_dropdown').click()">
                    <span>Mi cuenta</span> <i id="btn_dropdown" class="bi bi-chevron-down toggle-dropdown"></i>
                </a>
                <ul>
                    <li><a href="#" class="d-md-none">Agendar cita</a></li>
                    <li><a href="#">Mis citas</a></li>
                    <li><a href="#">Ficha médica</a></li>
                    <li><a href="{{ route('profile.show') }}" @click="mostrarPreloader()">Mi perfil</a></li>
                    <li>
                        <a href="#" @click.prevent="mostrarPreloader(); $root.querySelector('#logout_form').submit()">{{ __('Logout') }}</a>
                        <form id="logout_form" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="d-none">Cerrar sesión</button>
                        </form>
                    </li>
                </ul>
            </li>
        @endguest
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>

@guest
    <a x-data href="#" class="cta-btn d-none d-sm-block" @click.prevent="mostrarAlertAuth()">Agendar cita</a>
@else
    <a href="#" class="cta-btn d-none d-sm-block">Agendar cita</a>
@endguest

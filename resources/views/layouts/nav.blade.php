<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">

        {{-- Brand --}}
        <a class="navbar-brand d-flex align-items-center gap-1" href="{{ route('home') }}">
            <span class="fw-bold fs-4">J</span>
            <span class="fw-bold fs-4 text-warning">C</span>
            <span class="ms-1 fw-semibold">Empleos Honduras</span>
        </a>

        {{-- Toggle --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Menu --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">

                {{-- Plazas --}}
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1" href="{{ route('user.plazas') }}">
                        <i class="bi bi-briefcase"></i>
                        Plazas
                    </a>
                </li>

                @guest
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-1" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Iniciar sesión
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-4">
                            Registrarse
                        </a>
                    </li>
                @endguest

                @auth
                    @if(auth()->user()->hasVerifiedEmail())
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-1" href="{{ route('user.plazas') }}">
                                <i class="bi bi-send"></i>
                                Postular
                            </a>
                        </li>
                    @endif

                    {{-- User dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-1"
                           href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i>
                            {{ auth()->user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li>
                                <a class="dropdown-item" href="{{ route('cuenta.perfil') }}">
                                    <i class="bi bi-person"></i> Mi perfil
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

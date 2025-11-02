@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Menú lateral -->
        <div class="col-md-3 bg-light border-end vh-100 py-4">
            <h5 class="px-3">Mi Cuenta</h5>
            <ul class="nav flex-column px-3">
                <li class="nav-item mb-2">
                    <a href="{{ route('cuenta.perfil') }}" class="nav-link {{ request()->routeIs('cuenta.perfil') ? 'fw-bold text-primary' : 'text-dark' }}">
                        <i class="bi bi-person-lines-fill me-1"></i> Mi perfil
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('cuenta.postulaciones') }}" class="nav-link {{ request()->routeIs('cuenta.postulaciones') ? 'fw-bold text-primary' : 'text-dark' }}">
                        <i class="bi bi-card-checklist me-1"></i> Postulaciones
                    </a>
                </li>
                <li class="nav-item mb-2">
    <a href="{{ route('cuenta.configuracion') }}" class="nav-link {{ request()->routeIs('cuenta.configuracion') ? 'fw-bold text-primary' : 'text-dark' }}">
        <i class="bi bi-gear-fill me-1"></i> Configuración de cuenta
    </a>
</li>


                <!-- Puedes agregar más secciones aquí -->
            </ul>
        </div>

        <!-- Contenido principal -->
        <div class="col-md-9 py-4 px-5">
            @yield('cuenta-content')
        </div>
    </div>
</div>



<!-- Información de empresa -->
<div class="bg-dark text-white pt-5 pb-4 mt-5 shadow-sm w-100">
    <footer>
        <div class="container">
            <div class="row">

                <!-- Quiénes somos -->
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold">JC Empleos</h5>
                    <p>Conectamos talento hondureño con oportunidades laborales reales. Plataforma confiable y eficaz para candidatos.</p>
                </div>

                <!-- Enlaces rápidos -->
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold">Navegación</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ url('/') }}" class="text-white text-decoration-none"><i class="bi bi-house-door-fill me-1"></i>Inicio</a></li>
                        <li><a href="{{ route('user.plazas') }}" class="text-white text-decoration-none"><i class="bi bi-search me-1"></i>Buscar plazas</a></li>
                    </ul>
                </div>

                <!-- Redes sociales y contacto -->
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold">Contáctanos</h5>
                    <p>Email: contacto@jcempleos.com</p>
                    <p>Tel: (504) 2222-3333</p>
                    <div>
                        <a href="#" class="text-white me-3 fs-5"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white fs-5"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>

            </div>

            <hr class="border-light">
            <div class="text-center small">
                © {{ date('Y') }} JC Empleos. Todos los derechos reservados.
            </div>
        </div>
    </footer>
</div>
@endsection



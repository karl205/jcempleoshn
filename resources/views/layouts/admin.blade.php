<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - JC Empleos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    @stack('styles')
</head>
<body>
@if (session('mensaje'))
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
    <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
        {{ session('mensaje') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
</div>
@endif

<nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4">
    <a class="navbar-brand fw-bold" href="{{ route('home') }}">
        <span style="font-size: 1.5rem;">J<span class="text-warning">C</span> Empleos</span>
    </a>
    <div class="ms-auto">
        <span class="text-white me-3">Admin</span>
        <a href="#" class="btn btn-outline-light btn-sm">
    <i class="bi bi-box-arrow-right me-1"></i> Cerrar sesión
</a>

    </div>
</nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Menú lateral -->
            <div class="col-md-3 col-lg-2 bg-dark text-white p-4 min-vh-100">
                <h4 class="mb-4">Admin Panel</h4>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
    <i class="bi bi-house-door-fill me-2"></i>Dashboard
</a>

                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{ route('admin.plazas') }}"><i class="bi bi-briefcase-fill me-2"></i>Gestionar Plazas</a>
                    </li>
                    <li class="nav-item mb-2">
    <a class="nav-link text-white" href="{{ route('admin.postulaciones.index') }}">
        <i class="bi bi-person-lines-fill me-2"></i>Postulantes
    </a>
</li>

<li class="nav-item mb-2">
    <a class="nav-link text-white" href="{{ route('admin.filtrar-candidatos') }}">
        <i class="bi bi-funnel-fill me-2"></i>Filtrar Candidatos
    </a>
</li>

<li class="nav-item mb-2">
            <a class="nav-link text-white" href="{{ route('admin.catalogos') }}">
                <i class="bi bi-gear-fill me-2"></i>Catálogos
            </a>
        </li>
        
</li>

<li class="nav-item mb-2">
  <a class="nav-link text-white {{ request()->routeIs('admin.mensajes') ? 'active fw-semibold' : '' }}"
     href="{{ route('admin.mensajes') }}">
    <i class="bi bi-chat-left-quote-fill me-2"></i> Moderar mensajes
  </a>
</li>


@php
  $isSeguridadActive = request()->routeIs(
    'admin.usuarios',
    'admin.configuracion',
    'admin.bitacora',
    'admin.respaldo'
  );
@endphp

<li class="nav-item mb-2">
  <a class="nav-link text-white d-flex justify-content-between align-items-center"
     data-bs-toggle="collapse"
     href="#seguridadSubmenu"
     role="button"
     aria-expanded="{{ $isSeguridadActive ? 'true' : 'false' }}"
     aria-controls="seguridadSubmenu">
    <span><i class="bi bi-shield-lock-fill me-2"></i>Seguridad</span>
    <i class="bi bi-chevron-down small"></i>
  </a>

  <div class="collapse ps-4 {{ $isSeguridadActive ? 'show' : '' }}" id="seguridadSubmenu">
    <ul class="nav flex-column mt-2 list-unstyled">

      <li class="nav-item mb-1">
        <a class="nav-link text-white {{ request()->routeIs('admin.usuarios') ? 'active fw-semibold' : 'opacity-75' }}"
           href="{{ route('admin.usuarios') }}">
          <i class="bi bi-people-fill me-2"></i> Gestión de usuarios
        </a>
      </li>

      <li class="nav-item mb-1">
        <a class="nav-link text-white {{ request()->routeIs('admin.configuracion') ? 'active fw-semibold' : 'opacity-75' }}"
           href="{{ route('admin.configuracion') }}">
          <i class="bi bi-gear-fill me-2"></i> Configuración de acceso
        </a>
      </li>

      <li class="nav-item mb-1">
        <a class="nav-link text-white {{ request()->routeIs('admin.bitacora') ? 'active fw-semibold' : 'opacity-75' }}"
           href="{{ route('admin.bitacora') }}">
          <i class="bi bi-clipboard-data me-2"></i> Bitácora del sistema
        </a>
      </li>

      <li class="nav-item mb-1">
        <a class="nav-link text-white {{ request()->routeIs('admin.respaldo') ? 'active fw-semibold' : 'opacity-75' }}"
           href="{{ route('admin.respaldo') }}">
          <i class="bi bi-hdd-fill me-2"></i> Respaldo & Restore
          {{-- Ejemplo de badge de estado visual para la demo --}}
          <span class="badge rounded-pill bg-success ms-2">OK</span>
        </a>
      </li>
      


    </ul>
  </div>
</li>




</ul>

            </div>

            <!-- Contenido principal -->
            <div class="col-md-9 col-lg-10 p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- SweetAlert2 (con animaciones opcionales) -->

<link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet"/>


    @stack('scripts')
</body>
</html>

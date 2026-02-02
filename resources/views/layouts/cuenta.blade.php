@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/cuenta.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/perfil.css') }}">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">

        {{-- SIDEBAR --}}
        <aside class="col-md-3 col-lg-2 sidebar-cuenta p-4">
            <h6 class="text-muted mb-3">Mi Cuenta</h6>

            <ul class="nav flex-column gap-1">
                <li class="nav-item">
                    <a href="{{ route('cuenta.perfil') }}"
                       class="nav-link {{ request()->routeIs('cuenta.perfil') ? 'active' : '' }}">
                        <i class="bi bi-person"></i> Mi perfil
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cuenta.postulaciones') }}"
                       class="nav-link {{ request()->routeIs('cuenta.postulaciones') ? 'active' : '' }}">
                        <i class="bi bi-card-checklist"></i> Postulaciones
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cuenta.configuracion') }}"
                       class="nav-link {{ request()->routeIs('cuenta.configuracion') ? 'active' : '' }}">
                        <i class="bi bi-gear"></i> Configuración
                    </a>
                </li>
            </ul>
        </aside>

        {{-- CONTENIDO --}}
        <section class="col-md-9 col-lg-10 px-4">
            @yield('cuenta-content')
        </section>

    </div>
</div>
@endsection

{{-- @push('scripts')
<script src="{{ asset('assets/js/perfil.js') }}"></script>
@endpush --}}

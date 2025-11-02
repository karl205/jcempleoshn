@extends('layouts.admin')

@section('content')
<style>
    .dashboard-card {
        background: linear-gradient(to bottom right, #f8f9fa, #e9ecef);
        border-left: 6px solid;
        border-radius: 12px;
        transition: all 0.3s ease-in-out;
    }
    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }
    .dashboard-icon {
        font-size: 2rem;
        margin-right: 10px;
    }
</style>

    {{-- Encabezado con botón --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Bienvenido, Administrador</h3>
        <a href="{{ url('/') }}" class="btn btn-outline-primary">
            <i class="bi bi-house-door-fill me-1"></i>
            Volver a página principal
        </a>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card dashboard-card border-primary">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-1">Usuarios registrados</h5>
                        <p class="fs-4 text-primary mb-0">600</p>
                    </div>
                    <i class="bi bi-people-fill dashboard-icon text-primary"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card dashboard-card border-success">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-1">Plazas activas</h5>
                        <p class="fs-4 text-success mb-0">25</p>
                    </div>
                    <i class="bi bi-briefcase-fill dashboard-icon text-success"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card dashboard-card border-warning">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-1">Postulaciones recibidas</h5>
                        <p class="fs-4 text-warning mb-0">25</p>
                    </div>
                    <i class="bi bi-file-earmark-person-fill dashboard-icon text-warning"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card dashboard-card border-info">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-1">Postulaciones revisadas</h5>
                        <p class="fs-4 text-info mb-0">12</p>
                    </div>
                    <i class="bi bi-check2-circle dashboard-icon text-info"></i>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-5">

    <h5 class="mb-3">Últimas Postulaciones</h5>
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Carlos Martínez - Programador Web
            <span class="badge bg-success">Nuevo</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Ana Gómez - Asistente Contable
            <span class="badge bg-secondary">Revisado</span>
        </li>
    </ul>
@endsection




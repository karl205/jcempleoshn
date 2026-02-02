@extends('layouts.app')

@push('styles')
    <style>
        /* Sidebar sticky */
        .filter-card {
            position: sticky;
            top: 90px;
        }

        /* Card plaza hover sutil */
        .job-card {
            transition: transform .15s ease, box-shadow .15s ease;
        }

        .job-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .08);
        }

        .job-meta i {
            width: 18px;
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        <div class="row">

            <!-- FILTROS -->
            <div class="col-12 col-md-3 mb-4">
                <div class="card shadow-sm border-0 rounded-4 filter-card">
                    <div class="card-body p-4">

                        <h5 class="fw-bold text-center mb-4">
                            🔎 Filtrar plazas
                        </h5>

                        <form action="{{ route('user.plazas') }}" method="GET" class="vstack gap-3">

                            <select class="form-select rounded-pill" name="area">
                                <option selected disabled>Área de trabajo</option>
                                <option>Administración</option>
                                <option>Informática</option>
                                <option>Ventas</option>
                            </select>

                            <select class="form-select rounded-pill" name="cargo">
                                <option selected disabled>Cargo</option>
                                <option>Asistente</option>
                                <option>Gerente</option>
                                <option>Supervisor</option>
                            </select>

                            <select class="form-select rounded-pill" name="departamento">
                                <option selected disabled>Departamento</option>
                                <option>Francisco Morazán</option>
                                <option>Cortés</option>
                                <option>Olancho</option>
                            </select>

                            <button type="submit" class="btn btn-success rounded-pill py-2">
                                Buscar ahora
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- LISTADO -->
            <div class="col-12 col-md-9">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold mb-0">
                        Plazas disponibles
                    </h3>
                    <span class="text-muted small">
                        3 resultados
                    </span>
                </div>

                <div class="row row-cols-1 row-cols-md-2 g-4">

                    <!-- PLAZA -->
                    <div class="col">
                        <div class="card job-card h-100 border-0 rounded-4 shadow-sm">

                            <div class="card-body p-4">

                                <h5 class="fw-bold mb-1">
                                    Contador General
                                </h5>

                                <span class="badge bg-primary mb-3">
                                    Administración
                                </span>

                                <div class="job-meta small text-muted mb-3">

                                    <div class="mb-2">
                                        <i class="bi bi-gear text-primary"></i>
                                        Actividad: Financiero
                                    </div>

                                    <div class="mb-2">
                                        <i class="bi bi-geo-alt text-success"></i>
                                        Tegucigalpa, Francisco Morazán
                                    </div>

                                    <div>
                                        <i class="bi bi-clock text-warning"></i>
                                        Publicado hace 2 días
                                    </div>

                                </div>

                                <a href="{{ route('user.plazas.show', 1) }}"
                                    class="btn btn-outline-primary w-100 rounded-pill">
                                    Ver detalles
                                </a>

                            </div>
                        </div>
                    </div>

                    <!-- PLAZA -->
                    <div class="col">
                        <div class="card job-card h-100 border-0 rounded-4 shadow-sm">

                            <div class="card-body p-4">

                                <h5 class="fw-bold mb-1">
                                    Programador Web
                                </h5>

                                <span class="badge bg-primary mb-3">
                                    Informática
                                </span>

                                <div class="job-meta small text-muted mb-3">

                                    <div class="mb-2">
                                        <i class="bi bi-gear text-primary"></i>
                                        Actividad: Tecnología
                                    </div>

                                    <div class="mb-2">
                                        <i class="bi bi-geo-alt text-success"></i>
                                        San Pedro Sula, Cortés
                                    </div>

                                    <div>
                                        <i class="bi bi-clock text-warning"></i>
                                        Publicado hace 5 días
                                    </div>

                                </div>

                                <a href="{{ route('user.plazas.show', 2) }}"
                                    class="btn btn-outline-primary w-100 rounded-pill">
                                    Ver detalles
                                </a>

                            </div>
                        </div>
                    </div>

                    <!-- PLAZA -->
                    <div class="col">
                        <div class="card job-card h-100 border-0 rounded-4 shadow-sm">

                            <div class="card-body p-4">

                                <h5 class="fw-bold mb-1">
                                    Diseñador Gráfico
                                </h5>

                                <span class="badge bg-primary mb-3">
                                    Diseño
                                </span>

                                <div class="job-meta small text-muted mb-3">

                                    <div class="mb-2">
                                        <i class="bi bi-gear text-primary"></i>
                                        Actividad: Creativo
                                    </div>

                                    <div class="mb-2">
                                        <i class="bi bi-geo-alt text-success"></i>
                                        La Ceiba, Atlántida
                                    </div>

                                    <div>
                                        <i class="bi bi-clock text-warning"></i>
                                        Publicado hace 1 semana
                                    </div>

                                </div>

                                <a href="{{ route('user.plazas.show', 3) }}"
                                    class="btn btn-outline-primary w-100 rounded-pill">
                                    Ver detalles
                                </a>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

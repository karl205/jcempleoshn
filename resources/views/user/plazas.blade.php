@extends('layouts.app')

@push('styles')
<style>
    .card-header.bg-dark {
        background-color: rgb(30, 30, 30) !important; /* negro mate */
    }
</style>
@endpush

@section('content')




<div class="row">
    <!-- Filtro (columna izquierda) -->
    <div class="col-12 col-md-3 mb-4">


        <div class="card shadow-lg border-0 rounded-3 mb-4">
            <div class="card-body">
                <h5 class="text-center mb-4 text-dark">Filtrar Plazas</h5>
                <form action="{{ route('user.plazas') }}" method="GET" class="vstack gap-3">
                    <!-- Filtro de Área de Trabajo -->
                    <select class="form-select rounded-pill p-2" name="area">
                        <option selected disabled>Área de trabajo</option>
                        <option>Administración</option>
                        <option>Informática</option>
                        <option>Ventas</option>
                    </select>

                    <!-- Filtro de Cargo -->
                    <select class="form-select rounded-pill p-2" name="cargo">
                        <option selected disabled>Cargo</option>
                        <option>Asistente</option>
                        <option>Gerente</option>
                        <option>Supervisor</option>
                    </select>

                    <!-- Filtro de Departamento -->
                    <select class="form-select rounded-pill p-2" name="departamento">
                        <option selected disabled>Departamento</option>
                        <option>Francisco Morazán</option>
                        <option>Cortés</option>
                        <option>Olancho</option>
                    </select>

                    <!-- Botón de búsqueda -->
                    <button type="submit" class="btn btn-success w-100 rounded-pill p-2">🔍 Buscar ahora</button>
                </form>
            </div>
        </div>
    </div>

<!-- Plazas (columna derecha) -->
<div class="col-12 col-md-9">
    <h2 class="mb-4 text-dark">Plazas disponibles (3)</h2>
    <div class="row row-cols-1 row-cols-md-2 g-4">

        <!-- Tarjeta de Plaza 1 -->
        <div class="col">
            <div class="card h-100 border-0 shadow-lg rounded-3">
                <div class="card-header bg-primary text-white rounded-top d-flex justify-content-between align-items-center">
                    <!-- Cargo -->
                    <h5 class="mb-0">Contador General</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column mb-3">
                        <p class="card-text mb-2">
                            <i class="bi bi-gear text-secondary"></i> 
                            <strong>Actividad de trabajo:</strong> Financiero
                        </p>
                        <p class="card-text mb-2">
                            <i class="bi bi-briefcase text-info"></i> 
                            <strong>Categoría laboral:</strong> Administración
                        </p>
                        <p class="card-text mb-2">
                            <i class="bi bi-geo-alt text-success"></i> 
                            <strong>Ubicación:</strong> Tegucigalpa, Francisco Morazán
                        </p>
                        <p class="card-text mb-2">
                            <i class="bi bi-clock text-warning"></i> 
                            <strong>Publicado:</strong> hace 2 días
                        </p>
                    </div>
                    <a href="{{ route('user.plazas.show', 1) }}" target="_blank" class="btn btn-outline-primary w-100 rounded-pill">Ver detalles</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Plaza 2 -->
        <div class="col">
            <div class="card h-100 border-0 shadow-lg rounded-3">
                <div class="card-header bg-primary text-white rounded-top d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Programador Web</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column mb-3">
                        <p class="card-text mb-2">
                            <i class="bi bi-gear text-secondary"></i> 
                            <strong>Actividad de trabajo:</strong> Tecnología
                        </p>
                        <p class="card-text mb-2">
                            <i class="bi bi-briefcase text-info"></i> 
                            <strong>Categoría laboral:</strong> Informática
                        </p>
                        <p class="card-text mb-2">
                            <i class="bi bi-geo-alt text-success"></i> 
                            <strong>Ubicación:</strong> San Pedro Sula, Cortés
                        </p>
                        <p class="card-text mb-2">
                            <i class="bi bi-clock text-warning"></i> 
                            <strong>Publicado:</strong> hace 5 días
                        </p>
                    </div>
                    <a href="{{ route('user.plazas.show', 2) }}" target="_blank" class="btn btn-outline-primary w-100 rounded-pill">Ver detalles</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Plaza 3 -->
        <div class="col">
            <div class="card h-100 border-0 shadow-lg rounded-3">
                <div class="card-header bg-primary text-white rounded-top d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Diseñador Gráfico</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column mb-3">
                        <p class="card-text mb-2">
                            <i class="bi bi-gear text-secondary"></i> 
                            <strong>Actividad de trabajo:</strong> Creativo
                        </p>
                        <p class="card-text mb-2">
                            <i class="bi bi-briefcase text-info"></i> 
                            <strong>Categoría laboral:</strong> Diseño
                        </p>
                        <p class="card-text mb-2">
                            <i class="bi bi-geo-alt text-success"></i> 
                            <strong>Ubicación:</strong> La Ceiba, Atlántida
                        </p>
                        <p class="card-text mb-2">
                            <i class="bi bi-clock text-warning"></i> 
                            <strong>Publicado:</strong> hace 1 semana
                        </p>
                    </div>
                    <a href="{{ route('user.plazas.show', 3) }}" target="_blank" class="btn btn-outline-primary w-100 rounded-pill">Ver detalles</a>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- Estilos de personalización -->
<style>
    /* Se eliminó el hover para la tarjeta */
    .card {
        transition: none !important;
    }

    /* Estilos para los iconos */
    .bi {
        margin-right: 8px;
    }

    /* Opcional: Efectos para los botones */
    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }

    /* Asegurarse de que el logo no tenga márgenes no deseados */
    .card-header span {
        margin: 0;
    }

    /* Estilos para el logo en la parte superior derecha */
    .logo-top-right {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 1.4rem;
        font-weight: bold;
    }

    .logo-top-right span {
        display: inline-block;
    }

    /* Ajuste para la palabra "Empleos" con un peso más liviano y en blanco */
    .logo-top-right .font-weight-light {
        font-weight: 300; /* Fuente más delgada */
        color: white;
    }
</style>





<!-- Información de empresa -->
<footer class="bg-dark text-white pt-5 pb-4 mt-5 shadow-sm">
    <div class="container">
        <div class="row">

            <!-- Quiénes somos -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">JC Empleos</h5>
                <p>Conectamos talento hondureño con oportunidades laborales reales. Plataforma confiable y eficaz para empresas y candidatos.</p>
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
@endsection



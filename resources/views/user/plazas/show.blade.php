@extends('layouts.app')

@section('content')
    <!-- Toast -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
        <div id="toastPostulacion" class="toast align-items-center text-white bg-success border-0 shadow" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    🎉 ¡Postulación exitosa!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <div class="container py-4">

        <!-- Header -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">

                <h2 class="fw-bold mb-1">Programador Web</h2>

                <div class="text-muted mb-3">
                    <i class="bi bi-building me-1"></i> Confidencial
                    &nbsp;·&nbsp;
                    <i class="bi bi-geo-alt me-1"></i> Tegucigalpa, Francisco Morazán
                </div>

                <span class="badge bg-primary me-2">Tiempo completo</span>
                <span class="badge bg-secondary">Tecnología</span>

            </div>
        </div>

        <!-- Información -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">

                <h5 class="fw-bold mb-3">Información del puesto</h5>

                <div class="row g-3 small">

                    <div class="col-md-6">
                        <i class="bi bi-cash-coin text-primary me-2"></i>
                        <strong>Salario:</strong> L 25,000 – L 30,000
                    </div>

                    <div class="col-md-6">
                        <i class="bi bi-briefcase text-primary me-2"></i>
                        <strong>Experiencia:</strong> 2 años
                    </div>

                    <div class="col-md-6">
                        <i class="bi bi-mortarboard text-primary me-2"></i>
                        <strong>Nivel de estudio:</strong>
                        Ing. Sistemas o carrera afín
                    </div>

                    <div class="col-md-6">
                        <i class="bi bi-person text-primary me-2"></i>
                        <strong>Género:</strong> Indistinto
                    </div>

                    <div class="col-md-6">
                        <i class="bi bi-people text-primary me-2"></i>
                        <strong>Edad:</strong> 20 – 35 años
                    </div>

                    <div class="col-md-6">
                        <i class="bi bi-diagram-3 text-primary me-2"></i>
                        <strong>Actividad:</strong>
                        Desarrollo de software
                    </div>

                </div>

            </div>
        </div>

        <!-- Beneficios -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">

                <h5 class="fw-bold mb-3">Beneficios</h5>

                <ul class="mb-0">
                    <li>Seguro médico</li>
                    <li>Vacaciones pagadas</li>
                    <li>Bonificaciones por desempeño</li>
                </ul>

            </div>
        </div>

        <!-- Requisitos -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">

                <h5 class="fw-bold mb-3">Requisitos</h5>

                <ul>
                    <li>Título universitario en carrera afín</li>
                    <li>Experiencia mínima de 1 a 2 años</li>
                    <li>Conocimiento en frameworks modernos</li>
                    <li>Manejo de bases de datos</li>
                </ul>

            </div>
        </div>

        <!-- Acciones -->
        <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">

            <a href="{{ route('user.plazas') }}" class="btn btn-light d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i>
                Volver
            </a>

            <a href="#" id="btnPostular"
                class="btn btn-primary btn-lg rounded-pill d-flex align-items-center gap-2 px-4">
                <i class="bi bi-envelope-fill"></i>
                Postularme
            </a>

        </div>


    </div>

    <script>
        document.getElementById('btnPostular').addEventListener('click', function(e) {
            e.preventDefault();
            new bootstrap.Toast(
                document.getElementById('toastPostulacion')
            ).show();
        });
    </script>
@endsection

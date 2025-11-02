@extends('layouts.app')

@section('content')
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
    <div id="toastPostulacion" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                ✅ ¡Postulación exitosa!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
        </div>
    </div>
</div>

<div class="container py-4">
    <h2 class="mb-3 text-dark">Detalles de la Plaza</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">
                {{ $plaza->titulo ?? 'Programador Web' }}
            </h5>
        </div>
        <div class="card-body">
            <p><strong>Empresa:</strong> {{ $plaza->empresa->nombre ?? 'Confidencial' }}</p>
            <p><strong>Área:</strong> {{ $plaza->categoriaLaboral->nombre ?? 'Informática' }}</p>
            <p><strong>Ubicación:</strong>
                {{ $plaza->ciudad->nombre ?? 'Tegucigalpa' }},
                {{ $plaza->departamento->nombre ?? 'Francisco Morazán' }}
            </p>
            <p><strong>Salario estimado:</strong>
                @if(isset($plaza) && ($plaza->salario_min || $plaza->salario_max))
                    L {{ number_format($plaza->salario_min,0) }} - L {{ number_format($plaza->salario_max,0) }}
                @else
                    L 25,000 - L 30,000
                @endif
            </p>
            <p><strong>Experiencia requerida en años:</strong> {{ $plaza->experiencia_anios ?? '2 años' }}</p>
            <p><strong>Género preferido:</strong> {{ $plaza->genero_preferido ?? 'Indistinto' }}</p>

            
                    <p><strong>Nivel de estudio:</strong> {{ $plaza?->nivelEstudio?->nombre ?? 'Ing. Sistemas, Lic.Informatica Administrativa, o carreras afines' }}</p>
                    
                

                
                    <p><strong>Tipo de contrato:</strong> {{ $plaza?->tipoContrato?->nombre ?? 'Tiempo completo' }}</p>
                    
                

                
                    <p><strong>Rango de edad:</strong>@if(isset($plaza) && ($plaza->edad_min || $plaza->edad_max))
                            {{ $plaza->edad_min ?? '—' }} – {{ $plaza->edad_max ?? '—' }} años
                        @else
                            20 – 35 años
                        @endif</p>
                    
                

                
                    <p><strong>Actividad de trabajo:</strong>{{ $plaza?->actividadLaboral?->nombre ?? 'Desarrollo de software' }}</p>
                    
                

                
                    <p class="mb-1"><strong>Categoría laboral:</strong>{{ $plaza?->categoriaLaboral?->nombre ?? 'Tecnología' }}</p>
                    
                
            </div>

            <hr class="my-3">

            <p class="mb-1"><strong>Beneficios:</strong></p>
            <ul class="mb-3">
                @if(isset($plaza) && $plaza->beneficios?->count())
                    @foreach($plaza->beneficios as $b)
                        <li>{{ $b->nombre }}</li>
                    @endforeach
                @else
                    <li>Seguro médico</li>
                    <li>Vacaciones pagadas</li>
                    <li>Bonificaciones por desempeño</li>
                @endif
            </ul>

            <p class="mb-1"><strong>Requisitos:</strong></p>
            @if(isset($plaza) && !empty($plaza->detalle?->requisitos))
                {!! nl2br(e($plaza->detalle->requisitos)) !!}
            @else
                <ul>
                    <li>Título universitario en Ingeniería en Sistemas, Informática o carrera afín</li>
                    <li>Experiencia mínima de 1 a 2 años en desarrollo web</li>
                    <li>Conocimiento en HTML, CSS, JavaScript y frameworks modernos (React, Vue, etc.)</li>
                    <li>Manejo de bases de datos (MySQL, PostgreSQL, etc.)</li>
                    <li>Dominio de al menos un lenguaje backend (PHP, Node.js, Python, etc.)</li>
                    <li>Habilidad para trabajar en equipo y bajo presión</li>
                    <li>Disponibilidad inmediata</li>
                </ul>
            @endif

            <div class="text-center mt-5">
    <a href="{{ route('user.plazas') }}" class="btn btn-secondary btn-sm me-2">
        ← Volver a plazas
    </a>
    <a href="#" id="btnPostular" class="btn btn-primary btn-lg">
        📩 Postularme
    </a>
</div>

        </div>
    </div>
</div>

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

<script>
document.getElementById('btnPostular').addEventListener('click', function (e) {
    e.preventDefault();
    const toastElement = document.getElementById('toastPostulacion');
    const toast = new bootstrap.Toast(toastElement);
    toast.show();
});
</script>
@endsection


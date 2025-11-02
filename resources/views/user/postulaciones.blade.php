@extends('layouts.cuenta')

@section('cuenta-content')
<div class="container py-4">
    <h2 class="mb-4">Mis Postulaciones</h2>

    @php
        // Ejemplo con nuevos campos: actividad y categoría laboral
        $postulaciones = [
            [
                'id' => 1,
                'titulo' => 'Contador General',                 // Cargo
                'actividad' => 'Financiero',                   // Actividad de trabajo
                'categoria' => 'Administración',               // Categoría laboral
                'ubicacion' => 'Tegucigalpa, Francisco Morazán',
                'fecha' => '2025-08-01',                       // fecha de postulación
                'estado' => 'vigente'
            ],
            [
                'id' => 2,
                'titulo' => 'Programador Web',
                'actividad' => 'Tecnología',
                'categoria' => 'Informática',
                'ubicacion' => 'San Pedro Sula, Cortés',
                'fecha' => '2025-07-28',
                'estado' => 'cerrado'
            ],
            [
                'id' => 3,
                'titulo' => 'Diseñador Gráfico',
                'actividad' => 'Creativo',
                'categoria' => 'Diseño',
                'ubicacion' => 'La Ceiba, Atlántida',
                'fecha' => '2025-07-20',
                'estado' => 'cerrado'
            ],
        ];
    @endphp

    @forelse ($postulaciones as $p)
        <div class="card mb-3 shadow-sm border-0 position-relative">
            {{-- Cartel según estado --}}
            @if (($p['estado'] ?? '') === 'vigente')
                <span class="badge bg-success position-absolute top-0 end-0 m-2">Vigente</span>
            @else
                <span class="badge bg-danger position-absolute top-0 end-0 m-2">Proceso cerrado</span>
            @endif

            <div class="card-body">
                {{-- Cargo --}}
                <h5 class="card-title text-primary mb-3">{{ $p['titulo'] ?? 'Cargo' }}</h5>

                <div class="d-flex flex-column gap-1 mb-3">
                    <p class="mb-1">
                        <i class="bi bi-gear text-secondary me-1"></i>
                        <strong>Actividad de trabajo:</strong> {{ $p['actividad'] ?? '—' }}
                    </p>
                    <p class="mb-1">
                        <i class="bi bi-briefcase text-info me-1"></i>
                        <strong>Categoría laboral:</strong> {{ $p['categoria'] ?? '—' }}
                    </p>
                    <p class="mb-1">
                        <i class="bi bi-geo-alt text-success me-1"></i>
                        <strong>Ubicación:</strong> {{ $p['ubicacion'] ?? '—' }}
                    </p>
                    <p class="mb-0">
                        <i class="bi bi-calendar-check text-warning me-1"></i>
                        <strong>Fecha de postulación:</strong>
                        {{ isset($p['fecha']) ? \Carbon\Carbon::parse($p['fecha'])->diffForHumans() : '—' }}
                    </p>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('user.plazas.show', $p['id']) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        Ver detalles
                    </a>

                    @if (($p['estado'] ?? '') === 'vigente')
                        <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalCancelar{{ $p['id'] }}">
                            <i class="bi bi-x-circle me-1"></i> Cancelar postulación
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal de confirmación -->
        <div class="modal fade" id="modalCancelar{{ $p['id'] }}" tabindex="-1" aria-labelledby="modalLabel{{ $p['id'] }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="modalLabel{{ $p['id'] }}">¿Cancelar esta postulación?</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro que deseas cancelar tu postulación al cargo de
                        <strong>{{ $p['titulo'] }}</strong>? Esta acción no se puede deshacer.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, conservar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Sí, cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Aún no te has postulado a ninguna plaza.</div>
    @endforelse
</div>
@endsection




@extends('layouts.admin')

@section('content')

<h2 class="mb-4 text-primary">Gestionar Plazas</h2>

<div class="d-flex justify-content-between align-items-center mb-3">
  <p class="text-muted mb-0">
    <i class="bi bi-briefcase me-1"></i>
    Listado administrativo de plazas publicadas
  </p>
  <a href="{{ route('admin.plazas.crear') }}" class="btn btn-success">
    <i class="bi bi-plus-circle me-1"></i> Nueva Plaza
  </a>
</div>

{{-- Filtros (visual) --}}
<div class="card shadow-sm mb-4">
  <div class="card-body">
    <form class="row g-3 align-items-end">
      <div class="col-lg-3 col-md-6">
        <label class="form-label">Cargo</label>
        <select class="form-select">
          <option selected>Todos</option>
          <option>Programador Web</option>
          <option>Diseñador Gráfico</option>
        </select>
      </div>

      <div class="col-lg-3 col-md-6">
        <label class="form-label">Actividad de trabajo</label>
        <select class="form-select">
          <option selected>Todas</option>
          <option>Tecnología</option>
          <option>Creativo</option>
          <option>Financiero</option>
        </select>
      </div>

      <div class="col-lg-3 col-md-6">
        <label class="form-label">Categoría laboral</label>
        <select class="form-select">
          <option selected>Todas</option>
          <option>Informática</option>
          <option>Diseño</option>
          <option>Administración</option>
        </select>
      </div>

      <div class="col-lg-2 col-md-6">
        <label class="form-label">Departamento</label>
        <select class="form-select">
          <option selected>Todos</option>
          <option>Francisco Morazán</option>
          <option>Cortés</option>
          <option>Atlántida</option>
        </select>
      </div>

      <div class="col-lg-2 col-md-6">
        <label class="form-label">Ciudad</label>
        <select class="form-select">
          <option selected>Todas</option>
          <option>Tegucigalpa</option>
          <option>San Pedro Sula</option>
          <option>La Ceiba</option>
        </select>
      </div>

      <div class="col-lg-2 col-md-6">
        <label class="form-label">Estado</label>
        <select class="form-select">
          <option selected>Todos</option>
          <option>Activo</option>
          <option>Inactivo</option>
        </select>
      </div>

      <div class="col-lg-2 col-md-6">
        <label class="form-label">Desde</label>
        <input type="date" class="form-control">
      </div>

      <div class="col-lg-2 col-md-6">
        <label class="form-label">Hasta</label>
        <input type="date" class="form-control">
      </div>

      <div class="col-lg-2 col-md-6 d-grid">
        <button type="button" class="btn btn-primary">
          <i class="bi bi-funnel-fill me-1"></i> Filtrar
        </button>
      </div>
    </form>
  </div>
</div>

{{-- Resumen + paginación (placeholder visual) --}}
<div class="d-flex justify-content-between align-items-center mb-2">
  <small class="text-muted">
    Mostrando 1–2 de 2 plazas
  </small>
  <nav aria-label="Paginación de plazas">
    <ul class="pagination pagination-sm mb-0">
      <li class="page-item disabled"><span class="page-link">«</span></li>
      <li class="page-item active"><span class="page-link">1</span></li>
      <li class="page-item disabled"><span class="page-link">2</span></li>
      <li class="page-item disabled"><span class="page-link">»</span></li>
    </ul>
  </nav>
</div>

{{-- Tabla --}}
<div class="table-responsive">
  <table class="table table-bordered align-middle shadow-sm">
    <thead class="table-dark">
      <tr>
        <th style="width:64px">#</th>
        <th>Cargo</th>
        <th>Actividad</th>
        <th>Categoría</th>
        <th>Ubicación</th>
        <th>Estado</th>
        <th>Fecha de publicación</th>
        <th>Publicada por</th> {{-- NUEVA COLUMNA --}}
        <th style="width:200px">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ([
        [
          'id'=>1, 'cargo'=>'Programador Web', 'actividad'=>'Desarrollo de software', 'categoria'=>'Tecnología',
          'departamento'=>'Francisco Morazán', 'ciudad'=>'Tegucigalpa', 'estado'=>1,
          'fecha'=>'2025-08-01', 'empresa'=>'Confidencial', 'salario'=>'L 25,000 - L 30,000',
          'experiencia'=>'2 años', 'genero'=>'Indistinto',
          'nivel_estudio'=>'Ing. Sistemas, Lic. Informática Administrativa o afines',
          'tipo_contrato'=>'Tiempo completo', 'edad_min'=>20, 'edad_max'=>35,
          'publicada_por' => 'Juan Pérez (Empleado)', {{-- NUEVO CAMPO --}}
          'beneficios'=>['Seguro médico','Vacaciones pagadas','Bonificaciones por desempeño'],
          'requisitos'=>[
            'Título universitario en Ingeniería en Sistemas, Informática o carrera afín',
            'Experiencia mínima de 1 a 2 años en desarrollo web',
            'Conocimiento en HTML, CSS, JavaScript y frameworks modernos (React, Vue, etc.)',
            'Manejo de bases de datos (MySQL, PostgreSQL, etc.)',
            'Dominio de al menos un lenguaje backend (PHP, Node.js, Python, etc.)',
            'Habilidad para trabajar en equipo y bajo presión',
            'Disponibilidad inmediata'
          ]
        ],
        [
          'id'=>2, 'cargo'=>'Diseñador Gráfico', 'actividad'=>'Creativo', 'categoria'=>'Diseño',
          'departamento'=>'Cortés', 'ciudad'=>'San Pedro Sula', 'estado'=>0,
          'fecha'=>'2025-07-20', 'empresa'=>'Creativa S.A.', 'salario'=>'L 18,000 - L 22,000',
          'experiencia'=>'1 año', 'genero'=>'Indistinto',
          'nivel_estudio'=>'Lic. Diseño Gráfico o afines',
          'tipo_contrato'=>'Medio tiempo', 'edad_min'=>22, 'edad_max'=>35,
          'publicada_por' => 'María López (Empleado)', {{-- NUEVO CAMPO --}}
          'beneficios'=>['Vacaciones pagadas','Bonificaciones'],
          'requisitos'=>[
            'Título universitario en Diseño Gráfico o carrera afín',
            'Conocimiento en Adobe Photoshop, Illustrator y herramientas de diseño',
            'Creatividad y trabajo en equipo'
          ]
        ],
      ] as $plaza)
      <tr id="row-{{ $plaza['id'] }}">
        <td class="text-muted">#{{ $plaza['id'] }}</td>
        <td class="fw-semibold">{{ $plaza['cargo'] }}</td>
        <td>{{ $plaza['actividad'] }}</td>
        <td>{{ $plaza['categoria'] }}</td>
        <td>
          <i class="bi bi-geo-alt text-success"></i>
          {{ $plaza['ciudad'] }}, {{ $plaza['departamento'] }}
        </td>
        <td>
          <span id="badge-estado-{{ $plaza['id'] }}"
                class="badge {{ $plaza['estado'] ? 'bg-success' : 'bg-secondary' }}">
            {{ $plaza['estado'] ? 'Activo' : 'Inactivo' }}
          </span>
        </td>
        <td>{{ \Carbon\Carbon::parse($plaza['fecha'])->format('d/m/Y') }}</td>

        {{-- NUEVA CELDA: Publicada por --}}
        <td>{{ $plaza['publicada_por'] }}</td>

        {{-- ACCIONES (SIN CAMBIOS) --}}
        <td>
          <div class="d-flex flex-wrap gap-2">
            {{-- Ver (modal) --}}
            <button class="btn btn-sm btn-outline-info"
                    data-bs-toggle="modal"
                    data-bs-target="#verPlazaModal{{ $plaza['id'] }}"
                    title="Ver detalles">
              <i class="bi bi-eye-fill"></i>
            </button>

            {{-- Editar --}}
            <a href="{{ route('admin.plazas.editar', $plaza['id']) }}"
               class="btn btn-sm btn-outline-primary"
               title="Editar">
              <i class="bi bi-pencil-square"></i>
            </a>

            {{-- Activar / Cerrar --}}
            @if ($plaza['estado'])
              <button type="button"
                      class="btn btn-sm btn-outline-warning btn-cerrar"
                      data-id="{{ $plaza['id'] }}"
                      title="Cerrar plaza">
                <i class="bi bi-x-circle me-1"></i> Cerrar
              </button>
            @else
              <button type="button"
                      class="btn btn-sm btn-outline-success btn-activar"
                      data-id="{{ $plaza['id'] }}"
                      title="Activar plaza">
                <i class="bi bi-check-circle me-1"></i> Activar
              </button>
            @endif
          </div>
        </td>
      </tr>

      {{-- Modal Detalles (opcional: puedes agregar "Publicada por" aquí también) --}}
      <div class="modal fade" id="verPlazaModal{{ $plaza['id'] }}" tabindex="-1" aria-labelledby="modalLabel{{ $plaza['id'] }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-dark text-white">
              <h5 class="modal-title" id="modalLabel{{ $plaza['id'] }}">
                {{ $plaza['cargo'] }} — {{ $plaza['empresa'] }}
              </h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
              <div class="row g-3">
                <div class="col-md-6"><p><strong>Área:</strong> {{ $plaza['categoria'] }}</p></div>
                <div class="col-md-6"><p><strong>Ubicación:</strong> {{ $plaza['ciudad'] }}, {{ $plaza['departamento'] }}</p></div>
                <div class="col-md-6"><p><strong>Salario estimado:</strong> {{ $plaza['salario'] }}</p></div>
                <div class="col-md-6"><p><strong>Experiencia requerida:</strong> {{ $plaza['experiencia'] }}</p></div>
                <div class="col-md-6"><p><strong>Género preferido:</strong> {{ $plaza['genero'] }}</p></div>
                <div class="col-md-6"><p><strong>Nivel de estudio:</strong> {{ $plaza['nivel_estudio'] }}</p></div>
                <div class="col-md-6"><p><strong>Tipo de contrato:</strong> {{ $plaza['tipo_contrato'] }}</p></div>
                <div class="col-md-6"><p><strong>Rango de edad:</strong> {{ $plaza['edad_min'] }} – {{ $plaza['edad_max'] }} años</p></div>
                <div class="col-md-6"><p><strong>Actividad de trabajo:</strong> {{ $plaza['actividad'] }}</p></div>
                <div class="col-md-6">
                  <p><strong>Estado:</strong>
                    <span class="badge {{ $plaza['estado'] ? 'bg-success' : 'bg-secondary' }}">
                      {{ $plaza['estado'] ? 'Activo' : 'Inactivo' }}
                    </span>
                  </p>
                </div>
                <div class="col-md-6"><p><strong>Fecha de publicación:</strong> {{ \Carbon\Carbon::parse($plaza['fecha'])->format('d/m/Y') }}</p></div>
                <div class="col-md-6"><p><strong>Publicada por:</strong> {{ $plaza['publicada_por'] }}</p></div> {{-- OPCIONAL --}}
              </div>

              <hr>

              <p class="mb-1"><strong>Beneficios:</strong></p>
              <ul>
                @foreach($plaza['beneficios'] as $b)
                  <li>{{ $b }}</li>
                @endforeach
              </ul>

              <p class="mb-1"><strong>Requisitos:</strong></p>
              <ul>
                @foreach($plaza['requisitos'] as $r)
                  <li>{{ $r }}</li>
                @endforeach
              </ul>
            </div>
            <div class="modal-footer">
              <a href="{{ route('admin.plazas.editar', $plaza['id']) }}" class="btn btn-primary">
                <i class="bi bi-pencil-square me-1"></i> Editar
              </a>
              <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </tbody>
  </table>
</div>



{{-- JS Interacciones --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Tooltips
document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));

// Delegación: Activar / Cerrar
document.addEventListener('click', function (e) {
  const btnCerrar  = e.target.closest('.btn-cerrar');
  const btnActivar = e.target.closest('.btn-activar');

  if (btnCerrar) {
    const id = btnCerrar.dataset.id;
    Swal.fire({
      title: '¿Cerrar plaza?',
      text: 'La plaza se marcará como Inactiva. Podrás reactivarla cuando quieras.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, cerrar',
      cancelButtonText: 'Cancelar'
    }).then((r) => {
      if (r.isConfirmed) {
        const badge = document.getElementById('badge-estado-' + id);
        if (badge) {
          badge.classList.remove('bg-success');
          badge.classList.add('bg-secondary');
          badge.textContent = 'Inactivo';
        }
        btnCerrar.outerHTML = `
          <button type="button" class="btn btn-sm btn-outline-success btn-activar" data-id="${id}" title="Activar plaza" data-bs-toggle="tooltip">
            <i class="bi bi-check-circle me-1"></i> Activar
          </button>`;
        Swal.fire('¡Cerrada!', 'La plaza #' + id + ' se marcó como Inactiva.', 'success');
      }
    });
  }

  if (btnActivar) {
    const id = btnActivar.dataset.id;
    Swal.fire({
      title: '¿Activar plaza?',
      text: 'La plaza se marcará como Activa y volverá a recibir postulaciones.',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí, activar',
      cancelButtonText: 'Cancelar'
    }).then((r) => {
      if (r.isConfirmed) {
        const badge = document.getElementById('badge-estado-' + id);
        if (badge) {
          badge.classList.remove('bg-secondary');
          badge.classList.add('bg-success');
          badge.textContent = 'Activo';
        }
        btnActivar.outerHTML = `
          <button type="button" class="btn btn-sm btn-outline-warning btn-cerrar" data-id="${id}" title="Cerrar plaza" data-bs-toggle="tooltip">
            <i class="bi bi-x-circle me-1"></i> Cerrar
          </button>`;
        Swal.fire('¡Activada!', 'La plaza #' + id + ' se marcó como Activa.', 'success');
      }
    });
  }
});
</script>
@endpush

@endsection









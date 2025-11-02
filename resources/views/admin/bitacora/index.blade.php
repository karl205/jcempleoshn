@extends('layouts.admin')

@section('content')
<h2 class="mb-4 text-primary">Bitácora del sistema</h2>

{{-- Filtros (solo diseño, simples) --}}
<div class="card shadow-sm mb-3">
  <div class="card-body">
    <form class="row g-3 align-items-end" onsubmit="return false;">
      <div class="col-md-5">
        <label class="form-label">Buscar</label>
        <input type="text" class="form-control" placeholder="Ej. plaza, María, eliminar, login…">
      </div>
      <div class="col-md-3">
        <label class="form-label">Módulo</label>
        <select class="form-select">
          <option selected>Todos</option>
          <option>Plazas</option>
          <option>Usuarios</option>
          <option>Postulaciones</option>
          <option>Configuración</option>
          <option>Login</option>
        </select>
      </div>
      <div class="col-md-2">
        <label class="form-label">Desde</label>
        <input type="date" class="form-control">
      </div>
      <div class="col-md-2">
        <label class="form-label">Hasta</label>
        <input type="date" class="form-control">
      </div>
    </form>
  </div>
</div>

{{-- Timeline simple y legible (solo diseño) --}}
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <span class="fw-semibold">Últimos eventos</span>
    <div class="d-flex gap-2">
      <button type="button" class="btn btn-outline-secondary btn-sm" id="btn-export">
        <i class="bi bi-download me-1"></i> Exportar CSV
      </button>
      <button type="button" class="btn btn-outline-secondary btn-sm" id="btn-clear">
        <i class="bi bi-eraser me-1"></i> Limpiar filtros
      </button>
    </div>
  </div>

  <div class="card-body">
    <ul class="list-unstyled m-0">

      {{-- ITEM 1: Crear plaza --}}
      <li class="pb-3 mb-3 border-bottom">
        <div class="d-flex align-items-start gap-3">
          <div class="badge bg-primary rounded-pill px-3 py-2">Plazas</div>
          <div class="flex-grow-1">
            <div class="d-flex flex-wrap align-items-center gap-2">
              <span class="fw-semibold">María López</span>
              <span class="text-muted">·</span>
              <span class="badge bg-success">Crear</span>
              <span class="text-muted">·</span>
              <small class="text-secondary">2025-08-10 09:12 — IP 190.10.10.1</small>
            </div>
            <div class="mt-1">
              <div>Agregó una nueva plaza: <strong>Analista de Crédito</strong> (Tegucigalpa).</div>
              <button class="btn btn-sm btn-outline-primary mt-2 js-toggle" data-target="#chg-101">
                Ver cambios
              </button>
              <div id="chg-101" class="mt-2 d-none">
                <div class="row g-3">
                  <div class="col-md-6">
                    <div class="border rounded p-2 small bg-light">
                      <div class="fw-bold mb-1">Antes</div>
                      <pre class="mb-0">{ }</pre>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="border rounded p-2 small bg-light">
                      <div class="fw-bold mb-1">Después</div>
                      <pre class="mb-0">{ "titulo": "Analista de Crédito", "ciudad": "Tegucigalpa", "estado": "activo" }</pre>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-2">
              <span class="badge bg-dark">Administrador</span>
              <span class="badge bg-success">Éxito</span>
              <span class="badge bg-secondary">Chrome/Windows</span>
            </div>
          </div>
        </div>
      </li>

      {{-- ITEM 2: Actualizar plaza (p.ej. salario) --}}
      <li class="pb-3 mb-3 border-bottom">
        <div class="d-flex align-items-start gap-3">
          <div class="badge bg-primary rounded-pill px-3 py-2">Plazas</div>
          <div class="flex-grow-1">
            <div class="d-flex flex-wrap align-items-center gap-2">
              <span class="fw-semibold">Carlos Mejía</span>
              <span class="text-muted">·</span>
              <span class="badge bg-warning text-dark">Actualizar</span>
              <span class="text-muted">·</span>
              <small class="text-secondary">2025-08-10 09:01 — IP 190.10.10.5</small>
            </div>
            <div class="mt-1">
              <div>Actualizó la plaza <strong>Analista de Crédito</strong>: salario estimado y requisitos.</div>
              <button class="btn btn-sm btn-outline-primary mt-2 js-toggle" data-target="#chg-100">
                Ver cambios
              </button>
              <div id="chg-100" class="mt-2 d-none">
                <div class="row g-3">
                  <div class="col-md-6">
                    <div class="border rounded p-2 small bg-light">
                      <div class="fw-bold mb-1">Antes</div>
                      <pre class="mb-0">{ "salario_estimado": 18000, "requisitos": "Bachiller" }</pre>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="border rounded p-2 small bg-light">
                      <div class="fw-bold mb-1">Después</div>
                      <pre class="mb-0">{ "salario_estimado": 22000, "requisitos": "Técnico o Licenciatura" }</pre>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-2">
              <span class="badge bg-secondary">Empleado</span>
              <span class="badge bg-success">Éxito</span>
              <span class="badge bg-secondary">Firefox/Linux</span>
            </div>
          </div>
        </div>
      </li>

      {{-- ITEM 3: Inactivar plaza --}}
      <li class="pb-3 mb-3 border-bottom">
        <div class="d-flex align-items-start gap-3">
          <div class="badge bg-primary rounded-pill px-3 py-2">Plazas</div>
          <div class="flex-grow-1">
            <div class="d-flex flex-wrap align-items-center gap-2">
              <span class="fw-semibold">Admin JC</span>
              <span class="text-muted">·</span>
              <span class="badge bg-secondary">Inactivar</span>
              <span class="text-muted">·</span>
              <small class="text-secondary">2025-08-10 08:40 — IP 190.10.10.2</small>
            </div>
            <div class="mt-1">Inactivó la plaza <strong>Asesor Comercial</strong>.</div>
            <div class="mt-2">
              <span class="badge bg-dark">Administrador</span>
              <span class="badge bg-success">Éxito</span>
            </div>
          </div>
        </div>
      </li>

      {{-- ITEM 4: Eliminar postulante --}}
      <li class="pb-3 mb-3 border-bottom">
        <div class="d-flex align-items-start gap-3">
          <div class="badge bg-info text-dark rounded-pill px-3 py-2">Postulaciones</div>
          <div class="flex-grow-1">
            <div class="d-flex flex-wrap align-items-center gap-2">
              <span class="fw-semibold">María López</span>
              <span class="text-muted">·</span>
              <span class="badge bg-danger">Eliminar</span>
              <span class="text-muted">·</span>
              <small class="text-secondary">2025-08-10 08:22 — IP 190.10.10.1</small>
            </div>
            <div class="mt-1">Eliminó la postulación del usuario <strong>carlos@correo.com</strong> a <strong>Asesor Comercial</strong>.</div>
            <div class="mt-2">
              <span class="badge bg-dark">Administrador</span>
              <span class="badge bg-success">Éxito</span>
            </div>
          </div>
        </div>
      </li>

      {{-- ITEM 5: Login fallido --}}
      <li class="pb-1">
        <div class="d-flex align-items-start gap-3">
          <div class="badge bg-secondary rounded-pill px-3 py-2">Login</div>
          <div class="flex-grow-1">
            <div class="d-flex flex-wrap align-items-center gap-2">
              <span class="fw-semibold">maria@jcempleos.com</span>
              <span class="text-muted">·</span>
              <span class="badge bg-warning text-dark">Intento fallido</span>
              <span class="text-muted">·</span>
              <small class="text-secondary">2025-08-10 08:15 — IP 190.10.10.8</small>
            </div>
            <div class="mt-1">Intento de acceso con contraseña incorrecta.</div>
            <div class="mt-2">
              <span class="badge bg-secondary">Empleado</span>
              <span class="badge bg-danger">Error</span>
              <span class="badge bg-secondary">Chrome/Android</span>
            </div>
          </div>
        </div>
      </li>

    </ul>

    {{-- Paginación demo --}}
    <div class="mt-3 d-flex justify-content-between align-items-center">
      <div class="small text-muted">Haz clic en “Ver cambios” cuando exista.</div>
      <ul class="pagination pagination-sm mb-0">
        <li class="page-item disabled"><span class="page-link">Anterior</span></li>
        <li class="page-item active"><span class="page-link">1</span></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
      </ul>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  // Mostrar/ocultar bloques "Ver cambios"
  document.addEventListener('click', function(e){
    const btn = e.target.closest('.js-toggle');
    if(!btn) return;
    const target = document.querySelector(btn.getAttribute('data-target'));
    if(target){ target.classList.toggle('d-none'); }
  });

  // Exportar (demo)
  document.getElementById('btn-export')?.addEventListener('click', ()=>{
    Swal.fire({icon:'success', title:'Exportado (demo)', timer:1400, showConfirmButton:false});
  });

  // Limpiar filtros (demo)
  document.getElementById('btn-clear')?.addEventListener('click', ()=>{
    Swal.fire({icon:'info', title:'Filtros limpiados (demo)', timer:1200, showConfirmButton:false});
  });
</script>
@endpush



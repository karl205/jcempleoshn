@extends('layouts.admin')

@section('content')
<h2 class="mb-3 text-primary">Errores del sistema</h2>
<p class="text-muted">Solo diseño (demo). Registra excepciones y fallos técnicos.</p>

{{-- Filtros --}}
<div class="card shadow-sm mb-4">
  <div class="card-body">
    <form class="row g-3 align-items-end" onsubmit="return false;">
      <div class="col-md-3">
        <label class="form-label">Buscar (mensaje / ruta / requestId)</label>
        <input type="text" class="form-control" placeholder="Ej. SQLSTATE, 500, /plazas">
      </div>
      <div class="col-md-2">
        <label class="form-label">Nivel</label>
        <select class="form-select">
          <option>Todos</option>
          <option>Critical</option>
          <option>Error</option>
          <option>Warning</option>
          <option>Info</option>
        </select>
      </div>
      <div class="col-md-2">
        <label class="form-label">Servicio</label>
        <select class="form-select">
          <option>Todos</option>
          <option>Web</option>
          <option>Queue</option>
          <option>Scheduler</option>
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
      <div class="col-md-1">
        <button class="btn btn-primary w-100"><i class="bi bi-search"></i></button>
      </div>
    </form>
  </div>
</div>

{{-- Tabla --}}
<div class="card shadow-sm">
  <div class="card-body table-responsive">
    @php
      $badge = function($lvl){
        return match($lvl){
          'Critical' => 'bg-danger',
          'Error'    => 'bg-danger',
          'Warning'  => 'bg-warning text-dark',
          default    => 'bg-secondary',
        };
      };
      $rows = [
        ['id'=>501,'fecha'=>'2025-08-10 10:12:33','nivel'=>'Error','mensaje'=>'SQLSTATE[23000]: Integrity constraint violation','ruta'=>'POST /admin/usuarios','requestId'=>'req_8fA23','usuario'=>'admin@jcempleos.com','ip'=>'190.10.10.1','servicio'=>'Web','resuelto'=>false,'stack'=>"Illuminate\\Database\\QueryException...\n#1 ...\n#2 ..."],
        ['id'=>500,'fecha'=>'2025-08-10 02:05:01','nivel'=>'Warning','mensaje'=>'Backup tardó más de 5 min','ruta'=>'artisan backup:run','requestId'=>'job_bkp_20250810','usuario'=>null,'ip'=>null,'servicio'=>'Scheduler','resuelto'=>true,'stack'=>"app/Console/Kernel.php: schedule...\n"],
      ];
    @endphp

    <div class="d-flex justify-content-end gap-2 mb-2">
      <button class="btn btn-outline-secondary btn-sm" id="btn-export"><i class="bi bi-download me-1"></i> Exportar CSV (demo)</button>
      <button class="btn btn-outline-secondary btn-sm" id="btn-clear"><i class="bi bi-eraser me-1"></i> Limpiar filtros</button>
    </div>

    <table class="table align-middle">
      <thead class="table-light">
        <tr>
          <th>Fecha</th>
          <th>Nivel</th>
          <th>Mensaje</th>
          <th>Ruta / Servicio</th>
          <th>RequestID</th>
          <th>Usuario</th>
          <th>IP</th>
          <th class="text-end">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($rows as $r)
          <tr>
            <td>{{ $r['fecha'] }}</td>
            <td><span class="badge {{ $badge($r['nivel']) }}">{{ $r['nivel'] }}</span></td>
            <td class="text-truncate" style="max-width: 360px" title="{{ $r['mensaje'] }}">{{ $r['mensaje'] }}</td>
            <td>
              <div class="small">{{ $r['ruta'] }}</div>
              <div class="text-muted small">{{ $r['servicio'] }}</div>
            </td>
            <td><code>{{ $r['requestId'] }}</code></td>
            <td>{{ $r['usuario'] ?? '—' }}</td>
            <td>{{ $r['ip'] ?? '—' }}</td>
            <td class="text-end">
              <div class="btn-group">
                <button class="btn btn-sm btn-outline-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalErr-{{ $r['id'] }}">
                  <i class="bi bi-card-text"></i>
                </button>
                <button class="btn btn-sm {{ $r['resuelto'] ? 'btn-success' : 'btn-outline-success' }} btn-resolver"
                        data-id="{{ $r['id'] }}"
                        data-resuelto="{{ $r['resuelto'] ? '1':'0' }}">
                  <i class="bi bi-check2-circle"></i>
                </button>
              </div>
            </td>
          </tr>

          {{-- Modal detalle --}}
          <div class="modal fade" id="modalErr-{{ $r['id'] }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg"><div class="modal-content">
              <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Error #{{ $r['id'] }} · {{ $r['nivel'] }}</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <div class="row g-3">
                  <div class="col-md-6"><strong>Fecha:</strong> {{ $r['fecha'] }}</div>
                  <div class="col-md-6"><strong>RequestID:</strong> <code>{{ $r['requestId'] }}</code></div>
                  <div class="col-md-12"><strong>Mensaje:</strong> {{ $r['mensaje'] }}</div>
                  <div class="col-md-6"><strong>Ruta/Servicio:</strong> {{ $r['ruta'] }} ({{ $r['servicio'] }})</div>
                  <div class="col-md-6"><strong>Usuario/IP:</strong> {{ $r['usuario'] ?? '—' }} / {{ $r['ip'] ?? '—' }}</div>
                  <div class="col-md-12">
                    <strong>Stack trace:</strong>
                    <pre class="small bg-light p-2 border rounded">{{ $r['stack'] }}</pre>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              </div>
            </div></div>
          </div>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('btn-export')?.addEventListener('click', ()=> {
  Swal.fire({icon:'success', title:'Exportado (demo)', timer:1500, showConfirmButton:false});
});
document.getElementById('btn-clear')?.addEventListener('click', ()=> {
  Swal.fire({icon:'info', title:'Filtros limpiados (demo)', timer:1200, showConfirmButton:false});
});

// marcar como resuelto (demo)
document.addEventListener('click', e=>{
  const b = e.target.closest('.btn-resolver'); if(!b) return;
  const ya = b.dataset.resuelto==='1';
  b.classList.toggle('btn-success', true);
  b.classList.toggle('btn-outline-success', false);
  b.dataset.resuelto = '1';
  Swal.fire({toast:true, position:'top-end', icon:'success', title: ya?'Ya estaba resuelto':'Marcado como resuelto', timer:1200, showConfirmButton:false});
});
</script>
@endpush

@extends('layouts.admin')

@section('content')
<h2 class="mb-4 text-primary">Respaldo & Restore</h2>
<p class="text-muted">Muestra estado de backups y acciones simuladas.</p>

<div class="row g-4">
  {{-- Estado --}}
  <div class="col-md-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <div class="fw-bold">Último backup</div>
            <div class="text-muted small">Base de datos</div>
          </div>
          <i class="bi bi-hdd fs-3"></i>
        </div>
        <div class="mt-2">Hoy 02:00 AM</div>
        <div class="text-muted small">Tamaño aprox: 120 MB</div>
        <span class="badge bg-success mt-2">Correcto</span>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="fw-bold">Programación</div>
        <div class="text-muted small">Diario · 02:00 AM</div>
        <div class="text-muted small">Retención: 14 días</div>
        <span class="badge bg-info text-dark mt-2">Automático</span>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="fw-bold">Destino</div>
        <div class="text-muted small">S3 (bucket-demo)</div>
        <span class="badge bg-secondary mt-2">Off-site</span>
      </div>
    </div>
  </div>

  {{-- Acciones --}}
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="card-header bg-dark text-white">Acciones</div>
      <div class="card-body">
        <div class="d-flex flex-wrap gap-2">
          <button class="btn btn-primary" id="btn-backup">
            <i class="bi bi-cloud-arrow-up me-1"></i> Backup ahora
          </button>

          <label class="btn btn-outline-secondary mb-0" for="file-restore">
            <i class="bi bi-arrow-counterclockwise me-1"></i> Restaurar desde archivo
          </label>
          <input type="file" id="file-restore" class="d-none" disabled>

          <button class="btn btn-outline-danger" id="btn-clean">
            <i class="bi bi-trash3 me-1"></i> Limpiar backups antiguos
          </button>
        </div>
        <small class="text-muted d-block mt-2">Restore deshabilitado en demo.</small>
      </div>
    </div>
  </div>

  {{-- Configuración rápida (visual) --}}
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="card-header bg-dark text-white">Configuración (visual)</div>
      <div class="card-body">
        <form class="row g-3 align-items-end" onsubmit="return false;">
          <div class="col-md-3">
            <div class="form-check form-switch">
              <input class="form-check-input js-switch" type="checkbox" id="sw-auto" data-target=".grp-auto" checked>
              <label class="form-check-label" for="sw-auto">Backups automáticos</label>
            </div>
          </div>
          <div class="col-md-2 grp-auto">
            <label class="form-label">Frecuencia</label>
            <select class="form-select">
              <option>Diario</option>
              <option>Semanal</option>
            </select>
          </div>
          <div class="col-md-2 grp-auto">
            <label class="form-label">Hora</label>
            <input type="time" class="form-control" value="02:00">
          </div>
          <div class="col-md-2">
            <label class="form-label">Retención (días)</label>
            <input type="number" class="form-control" value="14" min="1">
          </div>
          <div class="col-md-3">
            <label class="form-label">Destino</label>
            <select class="form-select">
              <option>S3</option>
              <option>Local</option>
              <option>Google Drive</option>
            </select>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Historial de backups (demo) --}}
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="card-header bg-dark text-white">Historial reciente</div>
      <div class="card-body table-responsive">
        @php
          $items = [
            ['fecha'=>'2025-08-10 02:00','tipo'=>'DB','tam'=>'120 MB','estado'=>'OK','destino'=>'S3','archivo'=>'backup_2025-08-10.sql.gz'],
            ['fecha'=>'2025-08-09 02:00','tipo'=>'Archivos','tam'=>'480 MB','estado'=>'OK','destino'=>'S3','archivo'=>'storage_2025-08-09.zip'],
            ['fecha'=>'2025-08-08 02:00','tipo'=>'DB','tam'=>'118 MB','estado'=>'OK','destino'=>'S3','archivo'=>'backup_2025-08-08.sql.gz'],
          ];
          $badge = fn($s) => $s==='OK' ? 'bg-success' : 'bg-danger';
        @endphp
        <table class="table align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th>Fecha</th><th>Tipo</th><th>Tamaño</th><th>Estado</th><th>Destino</th><th>Archivo</th><th class="text-end">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($items as $it)
              <tr>
                <td>{{ $it['fecha'] }}</td>
                <td>{{ $it['tipo'] }}</td>
                <td>{{ $it['tam'] }}</td>
                <td><span class="badge {{ $badge($it['estado']) }}">{{ $it['estado'] }}</span></td>
                <td>{{ $it['destino'] }}</td>
                <td class="text-truncate" style="max-width:240px">{{ $it['archivo'] }}</td>
                <td class="text-end">
                  <button class="btn btn-sm btn-outline-secondary" disabled title="Descargar (demo)">
                    <i class="bi bi-download"></i>
                  </button>
                  <button class="btn btn-sm btn-outline-primary" disabled title="Restaurar (demo)">
                    <i class="bi bi-arrow-counterclockwise"></i>
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <small class="text-muted">Cuando conectemos backend, estos botones descargarán/restaurarán el archivo seleccionado.</small>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function toggleGroup(sw){
    const sels = (sw.dataset.target||'').split(',');
    sels.forEach(sel => document.querySelectorAll(sel.trim()).forEach(el=>{
      el.classList.toggle('d-none', !sw.checked);
    }));
  }
  // init
  document.addEventListener('DOMContentLoaded', ()=>{
    document.querySelectorAll('.js-switch').forEach(toggleGroup);
  });
  document.addEventListener('change', e=>{
    const sw = e.target.closest('.js-switch'); if(sw) toggleGroup(sw);
  });

  document.getElementById('btn-backup')?.addEventListener('click', ()=>{
    Swal.fire({icon:'success', title:'Backup iniciado (demo)', timer:1500, showConfirmButton:false});
  });
  document.getElementById('btn-clean')?.addEventListener('click', ()=>{
    Swal.fire({icon:'info', title:'Limpieza programada (demo)', timer:1500, showConfirmButton:false});
  });
</script>
@endpush

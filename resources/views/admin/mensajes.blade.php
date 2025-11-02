@extends('layouts.admin')

@push('styles')
<style>
  .admin-card { border:1px solid #e5e7eb; border-radius:12px; box-shadow:0 6px 18px rgba(0,0,0,.04); }
  .pill { display:inline-flex; align-items:center; gap:.4rem; padding:.25rem .6rem; border-radius:999px; font-size:.75rem; font-weight:600; }
  .pill-pend { background:#fff7ed; color:#9a3412; border:1px solid #fed7aa; }
  .pill-aprob { background:#ecfdf5; color:#065f46; border:1px solid #a7f3d0; }
  .pill-rech { background:#fef2f2; color:#991b1b; border:1px solid #fecaca; }

  .btn-lite { border:1px solid #e5e7eb; background:#fff; color:#374151; padding:.4rem .65rem; border-radius:.5rem; font-size:.85rem; }
  .btn-lite:hover { background:#f9fafb; }
  .btn-approve { border-color:#10b981; color:#065f46; }
  .btn-approve:hover { background:#ecfdf5; }
  .btn-reject { border-color:#ef4444; color:#991b1b; }
  .btn-reject:hover { background:#fef2f2; }
  .btn-delete { border-color:#6b7280; color:#374151; }
  .btn-delete:hover { background:#f3f4f6; }

  .table thead th { font-weight:700; color:#374151; border-bottom:1px solid #e5e7eb; }
  .table tbody td { vertical-align: middle; }
  .truncate-2 { display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
</style>
@endpush

@section('content')
  <h2 class="mb-3">Moderación de mensajes para la Landing</h2>
  <p class="text-muted mb-4">Revisa los mensajes enviados por usuarios. Aprobados aparecerán en la landing (cuando conectemos backend). Por ahora es solo visual.</p>

  @php
    // Mock para demo
    $mensajes = [
      ['id'=>1,'autor'=>'María Gómez','mensaje'=>'Encontré empleo en menos de dos semanas. Proceso claro y rápido.','fecha'=>'2025-08-10','estado'=>'pendiente'],
      ['id'=>2,'autor'=>'Carlos Pérez','mensaje'=>'Las alertas me ayudaron a aplicar a tiempo. Súper recomendado.','fecha'=>'2025-08-08','estado'=>'aprobado'],
      ['id'=>3,'autor'=>'Lucía Torres','mensaje'=>'Muy fácil crear mi CV y postularme desde el celular.','fecha'=>'2025-08-05','estado'=>'rechazado'],
      ['id'=>4,'autor'=>'Juan Ramírez','mensaje'=>'Encontré plaza en mi ciudad sin complicaciones.','fecha'=>'2025-08-03','estado'=>'pendiente'],
      ['id'=>5,'autor'=>'Ana Martínez','mensaje'=>'Plataforma fácil de usar y con muchas oportunidades.','fecha'=>'2025-07-29','estado'=>'pendiente'],
    ];
  @endphp

  <div class="admin-card p-3 mb-3">
    <div class="d-flex flex-wrap gap-2 align-items-center">
      <div class="input-group" style="max-width: 360px;">
        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
        <input id="searchBox" type="text" class="form-control" placeholder="Buscar por autor o contenido...">
      </div>

      <div class="ms-auto d-flex gap-2">
        <button class="btn-lite" data-filter="all"><i class="bi bi-ui-checks-grid me-1"></i>Todos</button>
        <button class="btn-lite" data-filter="pendiente"><i class="bi bi-hourglass-split me-1"></i>Pendientes</button>
        <button class="btn-lite" data-filter="aprobado"><i class="bi bi-check2-circle me-1"></i>Aprobados</button>
        <button class="btn-lite" data-filter="rechazado"><i class="bi bi-x-circle me-1"></i>Rechazados</button>
      </div>
    </div>
  </div>

  <div class="table-responsive admin-card">
    <table class="table mb-0">
      <thead>
        <tr>
          <th style="width:48px;"><input type="checkbox" id="checkAll"></th>
          <th>Autor</th>
          <th style="min-width:320px;">Mensaje</th>
          <th>Fecha</th>
          <th>Estado</th>
          <th style="min-width:220px;">Acciones</th>
        </tr>
      </thead>
      <tbody id="rowsContainer">
        @foreach ($mensajes as $m)
        <tr data-id="{{ $m['id'] }}" data-estado="{{ $m['estado'] }}">
          <td><input type="checkbox" class="row-check"></td>
          <td>{{ $m['autor'] }}</td>
          <td><div class="truncate-2">{{ $m['mensaje'] }}</div></td>
          <td>{{ \Carbon\Carbon::parse($m['fecha'])->format('d/m/Y') }}</td>
          <td class="estado-cell">
            @if($m['estado']==='aprobado')
              <span class="pill pill-aprob"><i class="bi bi-check2-circle"></i> Aprobado</span>
            @elseif($m['estado']==='rechazado')
              <span class="pill pill-rech"><i class="bi bi-x-circle"></i> Rechazado</span>
            @else
              <span class="pill pill-pend"><i class="bi bi-hourglass-split"></i> Pendiente</span>
            @endif
          </td>
          <td>
            <div class="d-flex flex-wrap gap-2">
              <button class="btn-lite btn-approve" data-action="approve"><i class="bi bi-check2"></i> Aprobar</button>
              <button class="btn-lite btn-reject" data-action="reject"><i class="bi bi-x"></i> Rechazar</button>
              <button class="btn-lite btn-delete" data-action="delete"><i class="bi bi-trash"></i> Eliminar</button>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Paginación ficticia -->
  <nav class="mt-3">
    <ul class="pagination pagination-sm mb-0">
      <li class="page-item disabled"><span class="page-link">Anterior</span></li>
      <li class="page-item active"><span class="page-link">1</span></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
    </ul>
  </nav>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const rows = document.querySelectorAll('#rowsContainer tr');
  const searchBox = document.getElementById('searchBox');
  const filterBtns = document.querySelectorAll('[data-filter]');

  // Buscar
  searchBox.addEventListener('input', () => {
    const q = searchBox.value.toLowerCase();
    rows.forEach(r => {
      const autor = r.children[1].textContent.toLowerCase();
      const msg = r.children[2].textContent.toLowerCase();
      r.style.display = (autor.includes(q) || msg.includes(q)) ? '' : 'none';
    });
  });

  // Filtros
  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const f = btn.getAttribute('data-filter');
      rows.forEach(r => {
        const estado = r.getAttribute('data-estado');
        r.style.display = (f === 'all' || estado === f) ? '' : 'none';
      });
    });
  });

  // Check all
  document.getElementById('checkAll').addEventListener('change', (e) => {
    document.querySelectorAll('.row-check').forEach(ch => ch.checked = e.target.checked);
  });

  // Acciones
  document.getElementById('rowsContainer').addEventListener('click', (e) => {
    const btn = e.target.closest('button[data-action]');
    if (!btn) return;
    const tr = btn.closest('tr');
    const estadoCell = tr.querySelector('.estado-cell');
    const action = btn.getAttribute('data-action');

    if (action === 'approve') {
      estadoCell.innerHTML = `<span class="pill pill-aprob"><i class="bi bi-check2-circle"></i> Aprobado</span>`;
      tr.setAttribute('data-estado', 'aprobado');
    }
    if (action === 'reject') {
      estadoCell.innerHTML = `<span class="pill pill-rech"><i class="bi bi-x-circle"></i> Rechazado</span>`;
      tr.setAttribute('data-estado', 'rechazado');
    }
    if (action === 'delete') {
      tr.remove();
    }
  });
});
</script>
@endpush




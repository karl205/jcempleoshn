<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        {{ $titulo }}
    </div>
    <div class="card-body">
        @php
    // Detecta si este bloque es para el catálogo "cargos"
    $isCargos = isset($catalogo) ? $catalogo === 'cargos'
                                 : (isset($titulo) && strtolower($titulo) === 'cargos');
@endphp

<form>
    @if ($isCargos)
        {{-- Vista especial para Cargos: categoría (vacía) y cargo (vacío y deshabilitado) --}}
        <div class="row g-2 mb-3">
            <div class="col-md-6">
                <label class="form-label">Categoría laboral</label>
                <select class="form-select" name="categoria" id="categoria">
                    <option value="">Seleccione...</option>
                    {{-- Por ahora sin opciones reales --}}
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Cargo</label>
                <select class="form-select" name="cargo" id="cargo" disabled>
                    <option value="">Seleccione una categoría primero</option>
                    {{-- Por ahora vacío: se llenará cuando haya categoría --}}
                </select>
            </div>
        </div>
        <div class="text-end">
            <button class="btn btn-success" type="submit">Agregar</button>
        </div>
    @else
        {{-- Comportamiento general para los demás catálogos --}}
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="{{ $placeholder }}">
            <button class="btn btn-success" type="submit">Agregar</button>
        </div>
    @endif
</form>


        @if (!empty($items))
            <div style="{{ $scroll ?? false ? 'max-height: 250px; overflow-y: auto;' : '' }}">
                <ul class="list-group">
                    @foreach ($items as $item)
@php
  $itemId   = is_object($item) ? ($item->id ?? $loop->index) : (is_array($item) ? ($item['id'] ?? $loop->index) : $loop->index);
  $itemName = is_object($item) ? ($item->nombre ?? (string)$item)
            : (is_array($item) ? ($item['nombre'] ?? (string)$item) : (string)$item);

  $deleteAction = \Illuminate\Support\Facades\Route::has('items.destroy') ? route('items.destroy', $itemId) : '#';
  $updateAction = \Illuminate\Support\Facades\Route::has('items.update')  ? route('items.update',  $itemId) : '#';
@endphp

<li id="li-item-{{ $itemId }}" class="list-group-item d-flex justify-content-between align-items-center">
  <span id="item-label-{{ $itemId }}">{{ $itemName }}</span>

  <div class="btn-group">
    <!-- EDITAR -->
    <button type="button"
            class="btn btn-sm btn-outline-primary"
            data-bs-toggle="modal"
            data-bs-target="#editarItem-{{ $itemId }}"
            title="Editar">
      <i class="bi bi-pencil-square"></i>
    </button>

    <!-- ELIMINAR -->
    <button type="button"
            class="btn btn-sm btn-outline-danger btn-delete-item"
            data-form="delete-item-{{ $itemId }}"
            data-li="li-item-{{ $itemId }}"
            data-nombre="{{ $itemName }}">
      <i class="bi bi-trash"></i>
    </button>
  </div>

  <!-- Form de borrado (demo usa '#') -->
  <form id="delete-item-{{ $itemId }}" action="{{ $deleteAction }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
  </form>
</li>

<!-- Modal EDITAR -->
<div class="modal fade" id="editarItem-{{ $itemId }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="form-edit-{{ $itemId }}" action="{{ $updateAction }}" method="POST" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Editar ítem</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <input type="text" name="nombre" id="input-edit-{{ $itemId }}" class="form-control" value="{{ $itemName }}" placeholder="Nuevo valor">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>
  </div>
</div>
@endforeach



                </ul>
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('click', function (e) {
  const btn = e.target.closest('.btn-delete-item');
  if (!btn) return;

  const formId = btn.dataset.form;
  const nombre = btn.dataset.nombre || 'este registro';

  Swal.fire({
    title: '¿Desea borrar?',
    text: `Se eliminará "${nombre}". Esta acción no se puede deshacer.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sí, borrar',
    cancelButtonText: 'Cancelar',
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById(formId)?.submit();
    }
  });
});
</script>



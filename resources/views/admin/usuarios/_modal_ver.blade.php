@php
  $id      = data_get($usuario, 'id');
  $nombre  = data_get($usuario, 'nombre', '—');
  $correo  = data_get($usuario, 'correo', '—');
  $rol     = data_get($usuario, 'rol', '—');        // Administrador | Empleado
  $estado  = data_get($usuario, 'estado', '—');     // Activo | Inactivo | Bloqueado
  $creado  = data_get($usuario, 'created_at');
  $ultimo  = data_get($usuario, 'last_login') ?? data_get($usuario, 'last_seen');

  $badgeEstado = $estado==='Activo' ? 'bg-success'
                : ($estado==='Inactivo' ? 'bg-secondary'
                : ($estado==='Bloqueado' ? 'bg-danger' : 'bg-light text-dark'));
  $badgeRol    = $rol==='Administrador' ? 'bg-primary' : 'bg-dark';
@endphp

<div class="modal fade" id="modalVerUsuario-{{ $id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Perfil de {{ $nombre }}</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body">
        <div class="row g-3 align-items-start">
          <div class="col-md-8">
            <div class="row g-3">
              <div class="col-md-6"><strong>Nombre:</strong> {{ $nombre }}</div>
              <div class="col-md-6"><strong>Correo:</strong> {{ $correo }}</div>
              <div class="col-md-6"><strong>Rol:</strong> <span class="badge {{ $badgeRol }}">{{ $rol }}</span></div>
              <div class="col-md-6"><strong>Estado:</strong> <span class="badge {{ $badgeEstado }}">{{ $estado }}</span></div>
              <div class="col-md-6"><strong>ID:</strong> {{ $id }}</div>
              <div class="col-md-6"><strong>Creado:</strong> {{ $creado ? \Carbon\Carbon::parse($creado)->format('d/m/Y H:i') : '—' }}</div>
              <div class="col-md-6"><strong>Último acceso:</strong> {{ $ultimo ? \Carbon\Carbon::parse($ultimo)->diffForHumans() : '—' }}</div>
            </div>
          </div>
          
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


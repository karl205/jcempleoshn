@extends('layouts.admin')

@section('content')
<h2 class="mb-4 text-primary">Usuarios del sistema (JC Empleos)</h2>

{{-- Filtros (solo diseño) --}}
<div class="card shadow-sm mb-4">
  <div class="card-body">
    <form class="row g-3 align-items-end" onsubmit="return false;">
      <div class="col-md-5">
        <label class="form-label">Buscar por nombre o correo</label>
        <input type="text" class="form-control" placeholder="Ej. Juan o juan@jcempleos.com">
      </div>
      <div class="col-md-3">
        <label class="form-label">Rol</label>
        <select class="form-select">
          <option selected>Todos</option>
          <option>Administrador</option>
          <option>Empleado</option>
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label">Estado</label>
        <select class="form-select">
          <option selected>Todos</option>
          <option>Activo</option>
          <option>Inactivo</option>
          <option>Bloqueado</option>
        </select>
      </div>
      <div class="col-md-1">
        <button type="submit" class="btn btn-primary w-100">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </form>
  </div>
</div>

{{-- Acciones top --}}
<div class="d-flex justify-content-between align-items-center mb-2">
  <div class="small text-muted">Vista demo (solo diseño).</div>
  <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearUsuario">
    <i class="bi bi-plus-circle me-1"></i> Nuevo usuario
  </button>
</div>

{{-- Tabla (demo) --}}
<div class="card shadow-sm">
  <div class="card-body table-responsive">
    @php
      $usuarios = [
        ['id'=>1,'nombre'=>'Juan Pérez','correo'=>'juan@jcempleos.com','rol'=>'Administrador','estado'=>'Activo','created_at'=>'2025-07-20 10:15','last_login'=>'2025-08-08 09:10'],
        ['id'=>2,'nombre'=>'María Gómez','correo'=>'maria@jcempleos.com','rol'=>'Empleado','estado'=>'Activo','created_at'=>'2025-07-22 14:30','last_login'=>'2025-08-10 07:45'],
        ['id'=>3,'nombre'=>'Carlos Ruiz','correo'=>'carlos@jcempleos.com','rol'=>'Empleado','estado'=>'Inactivo','created_at'=>'2025-07-25 12:00','last_login'=>null],
        ['id'=>4,'nombre'=>'Lucía Torres','correo'=>'lucia@jcempleos.com','rol'=>'Administrador','estado'=>'Bloqueado','created_at'=>'2025-07-28 09:25','last_login'=>'2025-08-01 18:20'],
      ];
      $badgeEstado = fn($e) => $e==='Activo' ? 'bg-success' : ($e==='Inactivo' ? 'bg-secondary' : 'bg-danger');
      $badgeRol = fn($r) => $r==='Administrador' ? 'bg-primary' : 'bg-dark';
    @endphp

    <table class="table align-middle">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Rol</th>
          <th>Estado</th>
          <th class="text-end">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($usuarios as $u)
          <tr id="tr-user-{{ $u['id'] }}">
            <td>{{ $u['id'] }}</td>
            <td>{{ $u['nombre'] }}</td>
            <td>{{ $u['correo'] }}</td>
            <td><span class="badge {{ $badgeRol($u['rol']) }}">{{ $u['rol'] }}</span></td>
            <td><span class="badge {{ $badgeEstado($u['estado']) }}">{{ $u['estado'] }}</span></td>
            <td class="text-end">
              <div class="btn-group">
                {{-- Ver --}}
                <button class="btn btn-sm btn-outline-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalVerUsuario-{{ $u['id'] }}"
                        title="Ver">
                  <i class="bi bi-person-badge"></i>
                </button>
                {{-- Editar --}}
                <button class="btn btn-sm btn-warning"
        data-bs-toggle="modal"
        data-bs-target="#modalEditarUsuario-{{ $u['id'] }}"
        title="Editar">
        <i class="bi bi-pencil-square"></i>
      </button>
                
              </div>
            </td>
          </tr>

          {{-- Modal Ver (parcial) --}}
          @include('admin.usuarios._modal_ver', ['usuario' => $u])

          {{-- Modal Editar (reemplazo completo) --}}
<div class="modal fade" id="modalEditarUsuario-{{ $u['id'] }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Editar usuario</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body">
        <form action="#"
              method="POST"
              onsubmit="return false;">
          @include('admin.usuarios._form', [
            'nombre'    => $u['nombre'],
            'correo'    => $u['correo'],
            'rol'       => $u['rol'],
            'estado'    => $u['estado'],
            'esEdicion' => true
          ])
        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button class="btn btn-primary" type="button">Guardar</button>
      </div>
    </div>
  </div>
</div>

        @endforeach
      </tbody>
    </table>
  </div>
</div>

{{-- Modal Crear --}}
<div class="modal fade" id="modalCrearUsuario" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="#" method="POST" class="modal-content" onsubmit="return false;">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Nuevo usuario</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        @include('admin.usuarios._form', ['esEdicion' => false])
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button class="btn btn-success" type="button">Crear (demo)</button>
      </div>
    </form>
  </div>
</div>
@endsection




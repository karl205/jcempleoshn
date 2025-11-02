@php
  $nombre    = $nombre    ?? '';
  $correo    = $correo    ?? '';
  $rol       = $rol       ?? null; // Administrador | Empleado (solo diseño)
  $estado    = $estado    ?? 'Activo';
  $esEdicion = $esEdicion ?? false;
@endphp

<div class="mb-3">
  <label class="form-label">Nombre completo</label>
  <input type="text" name="nombre" class="form-control" value="{{ $nombre }}" placeholder="Ej. Juan Pérez">
</div>

<div class="mb-3">
  <label class="form-label">Correo</label>
  <input type="email" name="correo" class="form-control" value="{{ $correo }}" placeholder="usuario@jcempleos.com">
</div>

<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Rol</label>
    <select name="rol" class="form-select">
      <option disabled {{ !$rol ? 'selected' : '' }}>Seleccione...</option>
      @foreach (['Administrador','Empleado'] as $r)
        <option value="{{ $r }}" {{ $rol===$r ? 'selected' : '' }}>{{ $r }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-6">
    <label class="form-label">Estado</label>
    <select name="estado" class="form-select">
      @foreach (['Activo','Inactivo','Bloqueado'] as $e)
        <option value="{{ $e }}" {{ $estado===$e ? 'selected' : '' }}>{{ $e }}</option>
      @endforeach
    </select>
  </div>
</div>

@if(!$esEdicion)
  <div class="row g-3 mt-2">
    <div class="col-md-6">
      <label class="form-label">Contraseña</label>
      <input type="password" name="password" class="form-control" placeholder="Mín. 8 caracteres">
    </div>
    <div class="col-md-6">
      <label class="form-label">Confirmar contraseña</label>
      <input type="password" name="password_confirmation" class="form-control" placeholder="Repite la contraseña">
    </div>
  </div>
@else
  <div class="alert alert-light border mt-3">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="chk-reset-pass" data-target="#area-reset-pass">
      <label class="form-check-label" for="chk-reset-pass">Cambiar contraseña</label>
    </div>
    <div id="area-reset-pass" class="row g-3 mt-2 d-none">
      <div class="col-md-6">
        <label class="form-label">Nueva contraseña</label>
        <input type="password" name="password" class="form-control">
      </div>
      <div class="col-md-6">
        <label class="form-label">Confirmar nueva contraseña</label>
        <input type="password" name="password_confirmation" class="form-control">
      </div>
    </div>
  </div>

  @push('scripts')
  <script>
    document.addEventListener('change', function(e){
      if(e.target && e.target.id === 'chk-reset-pass'){
        const tgt = document.querySelector(e.target.getAttribute('data-target'));
        if(tgt) tgt.classList.toggle('d-none', !e.target.checked);
      }
    });
  </script>
  @endpush
@endif


@extends('layouts.admin')

@section('content')
<h2 class="mb-4 text-primary">Configuración de acceso por rol</h2>

<div class="card shadow-sm">
  <div class="card-header d-flex flex-wrap gap-2 align-items-center">
    <div class="me-2 fw-semibold">Rol:</div>

    <select id="sel-rol" class="form-select w-auto">
      <option value="Administrador" selected>Administrador</option>
      <option value="Empleado">Empleado</option>
    </select>

    <button type="button" id="btn-add-rol" class="btn btn-outline-primary btn-sm ms-2">
      + Agregar rol
    </button>

    <div class="ms-auto small text-muted">
      * Editar/Eliminar requieren Ver
    </div>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th style="min-width:240px">Módulo</th>
            <th class="text-center" style="width:120px">Ver</th>
            <th class="text-center" style="width:120px">Editar</th>
            <th class="text-center" style="width:120px">Eliminar</th>
          </tr>
        </thead>
        <tbody id="tbody-permisos">
          <!-- Fila: Usuarios -->
          <tr data-mod="usuarios">
            <td class="fw-semibold">Usuarios</td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="ver"></td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="editar"></td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="eliminar"></td>
          </tr>

          <!-- Fila: Catálogos -->
          <tr data-mod="catalogos">
            <td class="fw-semibold">Catálogos</td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="ver"></td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="editar"></td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="eliminar"></td>
          </tr>

          <!-- Fila: Plazas -->
          <tr data-mod="plazas">
            <td class="fw-semibold">Plazas</td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="ver"></td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="editar"></td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="eliminar"></td>
          </tr>

          <!-- Fila: Postulantes por plaza -->
          <tr data-mod="postulantes">
            <td class="fw-semibold">Postulantes por plaza</td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="ver"></td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="editar"></td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="eliminar"></td>
          </tr>

          <!-- Fila: Filtro global de candidatos -->
          <tr data-mod="buscador_candidatos">
            <td class="fw-semibold">Filtro global de candidatos</td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="ver"></td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="editar"></td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="eliminar"></td>
          </tr>

          <!-- Fila: Auditoría -->
          <tr data-mod="auditoria">
            <td class="fw-semibold">Auditoría de accesos</td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="ver"></td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="editar"></td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="eliminar"></td>
          </tr>

          <!-- Fila: Moderación de mensajes -->
          <tr data-mod="comentarios">
            <td class="fw-semibold">Moderación de mensajes (Landing)</td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="ver"></td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="editar"></td>
            <td class="text-center"><input type="checkbox" class="form-check-input perm" data-acc="eliminar"></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="d-flex justify-content-end mt-3">
      <button type="button" class="btn btn-primary" id="btn-guardar-conf">
        <i class="bi bi-save me-1"></i> Guardar
      </button>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
(function(){
  // ======= MÓDULOS DEFINIDOS EN LA TABLA (mantener en sync con <tbody>)
  const MODULOS = [
    'usuarios','catalogos','plazas','postulantes',
    'buscador_candidatos','auditoria','comentarios'
  ];

  // ======= “Base de datos” en memoria (por rol)
  // Defaults de demo:
  const memory = {
    'Administrador': Object.fromEntries(MODULOS.map(m => [m, {ver:true, editar:true, eliminar:true}])),
    'Empleado': {
      usuarios: {ver:false, editar:false, eliminar:false},
      catalogos:{ver:false, editar:false, eliminar:false},
      plazas:   {ver:true,  editar:true,  eliminar:false},
      postulantes:{ver:true,editar:true,  eliminar:false},
      buscador_candidatos:{ver:true, editar:false, eliminar:false},
      auditoria:{ver:false, editar:false, eliminar:false},
      comentarios:{ver:false, editar:false, eliminar:false}
    }
  };

  // ======= Helpers DOM
  const $role = document.getElementById('sel-rol');
  const $tbody = document.getElementById('tbody-permisos');

  function getRow(mod){ return $tbody.querySelector(`tr[data-mod="${CSS.escape(mod)}"]`); }
  function getCb(mod, acc){ return getRow(mod)?.querySelector(`.perm[data-acc="${CSS.escape(acc)}"]`); }

  // ======= Pintar permisos del rol seleccionado
  function renderRole(role){
    // Si el rol no existe aún, inicializar en falso
    if(!memory[role]){
      memory[role] = Object.fromEntries(MODULOS.map(m => [m, {ver:false, editar:false, eliminar:false}]));
    }
    MODULOS.forEach(m => {
      const perms = memory[role][m] || {ver:false, editar:false, eliminar:false};
      ['ver','editar','eliminar'].forEach(a=>{
        const cb = getCb(m,a);
        if(cb) cb.checked = !!perms[a];
      });
    });
  }

  // ======= Dependencias: editar/eliminar -> ver; quitar ver apaga otros
  function enforceDependencies(mod, acc){
    const role = $role.value;
    const state = memory[role][mod];

    if((acc==='editar' || acc==='eliminar') && state[acc]){
      state.ver = true;
      const cbVer = getCb(mod,'ver'); if(cbVer) cbVer.checked = true;
    }
    if(acc==='ver' && !state.ver){
      state.editar = false; state.eliminar = false;
      const cbEd = getCb(mod,'editar'); if(cbEd) cbEd.checked = false;
      const cbEl = getCb(mod,'eliminar'); if(cbEl) cbEl.checked = false;
    }
  }

  // ======= Listeners
  document.addEventListener('change', (e)=>{
    const cb = e.target.closest('.perm');
    if(!cb) return;
    const mod = cb.closest('tr')?.getAttribute('data-mod');
    const acc = cb.getAttribute('data-acc');
    const role = $role.value;

    // Asegurar estructura
    memory[role] ??= Object.fromEntries(MODULOS.map(m => [m, {ver:false, editar:false, eliminar:false}]));
    memory[role][mod] ??= {ver:false, editar:false, eliminar:false};

    // Guardar valor y aplicar dependencias
    memory[role][mod][acc] = cb.checked;
    enforceDependencies(mod, acc);
  });

  $role.addEventListener('change', ()=> renderRole($role.value));

  // Demo: agregar rol
  document.getElementById('btn-add-rol')?.addEventListener('click', async ()=>{
    const { value: nombre } = await Swal.fire({
      title: 'Nuevo rol',
      input: 'text',
      inputLabel: 'Nombre del rol',
      inputPlaceholder: 'Ej. Revisor, Recursos Humanos, etc.',
      showCancelButton: true,
      inputValidator: v => (!v?.trim() ? 'Escribe un nombre' : null)
    });
    if(!nombre) return;
    const exists = Array.from($role.options).some(o => o.value.toLowerCase() === nombre.toLowerCase());
    if(exists){
      Swal.fire({icon:'info', title:'Ya existe', timer:1200, showConfirmButton:false});
      return;
    }
    // crear opción y estado por defecto
    const opt = document.createElement('option');
    opt.value = nombre; opt.textContent = nombre;
    $role.appendChild(opt);
    memory[nombre] = Object.fromEntries(MODULOS.map(m => [m, {ver:false, editar:false, eliminar:false}]));
    $role.value = nombre;
    renderRole(nombre);
  });

  // Guardar (demo)
  document.getElementById('btn-guardar-conf')?.addEventListener('click', ()=>{
    // Aquí podrías hacer POST con memory[$role.value] (cuando conectes backend)
    Swal.fire({
      icon: 'success',
      title: 'Configuración guardada (demo)',
      text: 'Solo diseño. Rol: ' + $role.value,
      timer: 1400,
      showConfirmButton: false
    });
    // console.log('Payload del rol actual:', $role.value, memory[$role.value]);
  });

  // Init
  renderRole($role.value);
})();
</script>
@endpush



@extends('layouts.admin')

@section('content')

  <h2 class="mb-4 text-primary">Crear Nueva Plaza</h2>

  <form action="#" method="POST" id="formPlaza">
      @csrf

      <div class="row">
        {{-- COLUMNA PRINCIPAL --}}
        <div class="col-lg-8">
          {{-- Información básica --}}
          <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white d-flex align-items-center justify-content-between">
              <span><i class="bi bi-info-circle me-2"></i>Información Básica</span>
              <span class="small text-white-50">Paso 1 de 2</span>
            </div>
            <div class="card-body row g-3">
              {{-- Actividad laboral --}}
              <div class="col-md-4">
                <label class="form-label">Actividad laboral <span class="text-danger">*</span></label>
                <select class="form-select" id="actividad" required>
                  <option selected disabled>Seleccione una actividad</option>
                  <option value="desarrollo">Desarrollo de software</option>
                  <option value="creativo">Creativo/Diseño</option>
                  <option value="finanzas">Finanzas/Contabilidad</option>
                  <option value="soporte">Soporte/Infraestructura</option>
                  <option value="administracion">Administración</option>
                </select>
              </div>

              {{-- Categoría --}}
              <div class="col-md-4">
                <label class="form-label">Categoría <span class="text-danger">*</span></label>
                <select class="form-select" id="categoria" disabled required>
                  <option selected disabled>Seleccione una categoría</option>
                </select>
              </div>

              {{-- Cargo --}}
              <div class="col-md-4">
                <label class="form-label">Cargo <span class="text-danger">*</span></label>
                <select class="form-select" id="cargo" disabled required>
                  <option selected disabled>Seleccione un cargo</option>
                </select>
              </div>

              {{-- Departamento --}}
              <div class="col-md-6">
                <label class="form-label">Departamento <span class="text-danger">*</span></label>
                <select class="form-select" id="departamento" required>
                  <option selected disabled>Selecciona un departamento</option>
                  <option value="Francisco Morazán">Francisco Morazán</option>
                  <option value="Cortés">Cortés</option>
                  <option value="Olancho">Olancho</option>
                </select>
              </div>

              {{-- Ciudad --}}
              <div class="col-md-6">
                <label class="form-label">Ciudad <span class="text-danger">*</span></label>
                <select class="form-select" id="ciudad" disabled required>
                  <option selected disabled>Selecciona una ciudad</option>
                </select>
              </div>
            </div>
          </div>

          {{-- Detalle de la plaza --}}
          <div class="card shadow-sm mb-4">
            <div class="card-header bg-secondary text-white d-flex align-items-center justify-content-between">
              <span><i class="bi bi-sliders me-2"></i>Detalles de la Plaza</span>
              <span class="small text-white-50">Paso 2 de 2</span>
            </div>

            <div class="card-body row g-3">
              {{-- Nivel de estudio --}}
              <div class="col-md-6">
                <label class="form-label">Nivel de Estudio</label>
                <select class="form-select" name="nivel_estudio[]" multiple style="height: 150px;">
                  <option>Bachillerato</option>
                  <option>Técnico</option>
                  <option>Universitario</option>
                  <option>Postgrado</option>
                  <option>Maestría</option>
                  <option>Carreras afines</option>
                  <option>Doctorado</option>
                  <option>Especialización</option>
                  <option>Diplomado</option>
                  <option>Certificación técnica</option>
                </select>
                <small class="text-muted">Puedes seleccionar varios con Ctrl/Cmd.</small>
              </div>

              {{-- Áreas de estudio --}}
              <div class="col-md-6">
                <label class="form-label">Áreas de Estudio</label>
                <select class="form-select" name="areas_estudio[]" multiple style="height: 150px;">
                  <option>Ingeniería de Sistemas</option>
                  <option>Ciencias de la Computación</option>
                  <option>Diseño Gráfico</option>
                  <option>Administración de Empresas</option>
                  <option>Contaduría</option>
                  <option>Finanzas</option>
                  <option>Telecomunicaciones</option>
                  <option>Redes y Seguridad</option>
                  <option>Mercadeo</option>
                  <option>Recursos Humanos</option>
                </select>
              </div>

              {{-- Beneficios (ESCRITOS POR TI, uno por línea) --}}
              <div class="col-md-6">
                <label class="form-label">Beneficios</label>
                <textarea id="ta_beneficios" class="form-control" rows="6"
                  placeholder="Escribe un beneficio por línea&#10;Ej.: Seguro médico&#10;Bono por desempeño&#10;Horario flexible"></textarea>
                <small class="text-muted d-block mt-1">Se mostrarán como chips a la derecha.</small>
              </div>

              <div class="col-md-6">
                <label class="form-label d-flex align-items-center">
                  Previsualización de Beneficios
                  <i class="bi bi-eye ms-2 text-muted"></i>
                </label>
                <div id="chips_beneficios" class="d-flex flex-wrap gap-2"></div>
                <small class="text-muted d-block mt-1">Haz clic en la ✕ de un chip para quitarlo también del texto.</small>
              </div>

              <div class="col-md-6">
                <label class="form-label">Tipo de Contratación</label>
                <select class="form-select" id="tipo_contratacion">
                  <option selected disabled>Selecciona una opción</option>
                  <option value="permanente">Permanente</option>
                  <option value="temporal">Temporal</option>
                </select>
              </div>

              <div class="col-md-3">
                <label class="form-label">Sexo</label>
                <select class="form-select" id="sexo">
                  <option>Indistinto</option>
                  <option>Masculino</option>
                  <option>Femenino</option>
                </select>
              </div>

              <div class="col-md-3">
                <label class="form-label">Rango de Edad</label>
                <select class="form-select" id="rango_edad">
                  <option disabled selected>Selecciona una opción</option>
                  <option>18 - 25 años</option>
                  <option>26 - 35 años</option>
                  <option>36 - 45 años</option>
                  <option>46 o más</option>
                </select>
              </div>

              <div class="col-md-3">
                <label class="form-label">Años de Experiencia</label>
                <input type="number" class="form-control" id="experiencia" min="0" placeholder="Ej: 2">
              </div>

              <div class="col-md-3">
                <label class="form-label">Salario estimado</label>
                <input type="text" class="form-control" id="salario" placeholder="Ej: L 18,000">
              </div>

              {{-- Perfil del Puesto (ESCRITO POR TI, uno por línea) --}}
              <div class="col-md-6">
                <label class="form-label">Perfil del Puesto</label>
                <textarea class="form-control" rows="6" id="ta_perfil"
                  placeholder="Escribe el perfil deseado, uno por línea&#10;Ej.: 2+ años en desarrollo web&#10;Conocimiento de Laravel y MySQL&#10;Trabajo en equipo"></textarea>
                <small class="text-muted d-block mt-1">Se previsualiza como lista a la derecha.</small>
              </div>

              <div class="col-md-6">
                <label class="form-label d-flex align-items-center">
                  Previsualización del Perfil
                  <i class="bi bi-eye ms-2 text-muted"></i>
                </label>
                <div id="chips_perfil" class="d-flex flex-wrap gap-2"></div>
                <small class="text-muted d-block mt-1">Puedes quitar bullets desde la ✕ y se eliminarán del texto.</small>
              </div>
            </div>

            <div class="card-footer">
              {{-- Progreso visual --}}
              <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Progreso</small>
                <span class="badge bg-info" id="progressPct">0%</span>
              </div>
              <div class="progress mt-2" style="height: 8px;">
                <div class="progress-bar bg-info" id="progressBar" style="width: 0%;"></div>
              </div>
            </div>
          </div>

          <div class="d-grid">
            <button type="button" class="btn btn-success btn-lg" onclick="simularPublicacion()">
              <i class="bi bi-check2-circle me-1"></i> Guardar Plaza
            </button>
          </div>
        </div>

        {{-- ASIDE --}}
        <div class="col-lg-4">
          <div class="position-sticky" style="top: 1rem;">
            <div class="card shadow-sm mb-3">
              <div class="card-header bg-light">
                <i class="bi bi-clipboard-check me-2"></i>Resumen rápido
              </div>
              <div class="card-body">
                <ul class="list-unstyled mb-2 small text-muted">
                  <li class="mb-1"><i class="bi bi-dot text-primary"></i> Actividad, Categoría y Cargo</li>
                  <li class="mb-1"><i class="bi bi-dot text-primary"></i> Departamento y Ciudad</li>
                  <li class="mb-1"><i class="bi bi-dot text-primary"></i> Detalles generales</li>
                </ul>
                <hr>
                <div class="small">
                  <div class="mb-1"><strong>Ubicación: </strong><span id="prevUbicacion" class="text-muted">—</span></div>
                  <div class="mb-1"><strong>Área/Categoría: </strong><span id="prevCategoria" class="text-muted">—</span></div>
                  <div class="mb-1"><strong>Cargo: </strong><span id="prevCargo" class="text-muted">—</span></div>
                  <div class="mb-1"><strong>Tipo contratación: </strong><span id="prevTipo" class="text-muted">—</span></div>
                  <div class="mb-1"><strong>Experiencia: </strong><span id="prevExp" class="text-muted">—</span></div>
                  <div class="mb-1"><strong>Salario: </strong><span id="prevSalario" class="text-muted">—</span></div>
                </div>
              </div>
            </div>

            <div class="card shadow-sm">
              <div class="card-header bg-light">
                <i class="bi bi-ui-checks-grid me-2"></i>Notas
              </div>
              <div class="card-body small text-muted">
                Escribe beneficios y perfil por líneas: la vista previa los convierte en chips/bullets.
              </div>
            </div>
          </div>
        </div>
      </div>
  </form>

  @push('css')
  <style>
    #chips_beneficios .chip, #chips_perfil .chip{
      display:inline-flex; align-items:center; padding:.25rem .5rem; border-radius:20px;
      border:1px solid #dee2e6; font-size:.8rem;
    }
    #chips_beneficios .chip i, #chips_perfil .chip i{ cursor:pointer; margin-left:.35rem; opacity:.7; }
  </style>
  @endpush

  @push('scripts')
  {{-- Bootstrap Icons (si tu layout no lo trae) --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  {{-- SweetAlert2 --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
  // Guardado simulado
  function simularPublicacion() {
    if(!validacionBasica()){
      Swal.fire('Campos faltantes','Completa los campos marcados con *','warning');
      return;
    }
    Swal.fire({
      title: '¡Publicación exitosa!',
      text: 'La plaza ha sido guardada correctamente.',
      icon: 'success',
      confirmButtonColor: '#198754',
      confirmButtonText: 'Aceptar',
      showConfirmButton: true,
      timer: 1800,
      timerProgressBar: true,
    }).then(() => {
      window.location.href = "{{ route('admin.plazas') }}";
    });
  }

  // Dependencias Departamento -> Ciudad
  const ciudadesPorDepartamento = {
    'Francisco Morazán': ['Tegucigalpa', 'Comayagüela', 'Valle de Ángeles'],
    'Cortés': ['San Pedro Sula', 'Puerto Cortés', 'La Lima'],
    'Olancho': ['Juticalpa', 'Catacamas', 'La Unión']
  };
  const selDepto = document.getElementById('departamento');
  const selCiudad = document.getElementById('ciudad');

  selDepto.addEventListener('change', function () {
    const ciudades = ciudadesPorDepartamento[this.value] || [];
    selCiudad.innerHTML = '<option selected disabled>Selecciona una ciudad</option>';
    ciudades.forEach(c => {
      const opt = document.createElement('option');
      opt.value = c; opt.text = c;
      selCiudad.appendChild(opt);
    });
    selCiudad.disabled = ciudades.length === 0;
    actualizarPreview();
    updateProgress();
  });
  selCiudad.addEventListener('change', ()=>{ actualizarPreview(); updateProgress(); });

  // Dependencias Actividad -> Categoría -> Cargo
  const categoriasPorActividad = {
    'desarrollo': ['Backend', 'Frontend', 'Full Stack', 'QA/Testing'],
    'creativo': ['Diseño Gráfico', 'UI/UX', 'Multimedia'],
    'finanzas': ['Contabilidad', 'Tesorería', 'Auditoría'],
    'soporte': ['Mesa de Ayuda', 'Redes', 'Seguridad'],
    'administracion': ['Asistencia', 'Coordinación', 'Gerencia']
  };
  const cargosPorCategoria = {
    'Backend': ['Programador PHP', 'Programador .NET', 'Desarrollador Java'],
    'Frontend': ['Desarrollador React', 'Desarrollador Vue', 'Maquetador'],
    'Full Stack': ['Full Stack Laravel', 'Full Stack Node'],
    'QA/Testing': ['QA Manual', 'QA Automatización'],
    'Diseño Gráfico': ['Diseñador Gráfico Jr.', 'Diseñador Gráfico Sr.'],
    'UI/UX': ['Product Designer', 'UX Researcher'],
    'Multimedia': ['Editor de Video', 'Animator'],
    'Contabilidad': ['Asistente Contable', 'Contador General'],
    'Tesorería': ['Analista de Tesorería'],
    'Auditoría': ['Auditor Interno'],
    'Mesa de Ayuda': ['Técnico de Soporte'],
    'Redes': ['Administrador de Redes'],
    'Seguridad': ['Analista de Seguridad'],
    'Asistencia': ['Asistente Administrativo'],
    'Coordinación': ['Coordinador Operativo'],
    'Gerencia': ['Gerente Administrativo']
  };

  const actividadSelect = document.getElementById('actividad');
  const categoriaSelect = document.getElementById('categoria');
  const cargoSelect     = document.getElementById('cargo');

  actividadSelect.addEventListener('change', function () {
    const categorias = categoriasPorActividad[this.value] || [];
    categoriaSelect.innerHTML = '<option selected disabled>Seleccione una categoría</option>';
    categorias.forEach(cat => {
      const opt = document.createElement('option');
      opt.value = cat; opt.text = cat;
      categoriaSelect.appendChild(opt);
    });
    categoriaSelect.disabled = categorias.length === 0;
    cargoSelect.innerHTML = '<option selected disabled>Seleccione un cargo</option>';
    cargoSelect.disabled = true;
    actualizarPreview(); updateProgress();
  });

  categoriaSelect.addEventListener('change', function () {
    const cargos = cargosPorCategoria[this.value] || [];
    cargoSelect.innerHTML = '<option selected disabled>Seleccione un cargo</option>';
    cargos.forEach(cg => {
      const opt = document.createElement('option');
      opt.value = cg; opt.text = cg;
      cargoSelect.appendChild(opt);
    });
    cargoSelect.disabled = cargos.length === 0;
    actualizarPreview(); updateProgress();
  });

  cargoSelect.addEventListener('change', function(){
    actualizarPreview(); updateProgress();
  });

  // ------ Chips de texto (beneficios y perfil) ------
  function buildChips(textarea, container){
    const lines = (textarea.value || '')
      .split(/\r?\n/)
      .map(t => t.trim())
      .filter(Boolean);

    container.innerHTML = '';
    lines.forEach((line, idx) => {
      const chip = document.createElement('span');
      chip.className = 'chip';
      chip.textContent = line;

      const x = document.createElement('i');
      x.className = 'bi bi-x-lg ms-2';
      x.title = 'Quitar';
      x.onclick = ()=>{
        // quitar del textarea también
        const arr = (textarea.value || '')
          .split(/\r?\n/)
          .map(t=>t.trim());
        const pos = arr.indexOf(line);
        if (pos > -1) { arr.splice(pos, 1); }
        textarea.value = arr.filter(Boolean).join('\n');
        buildChips(textarea, container);
      };

      chip.appendChild(x);
      container.appendChild(chip);
    });
  }
  function debounced(fn, ms=250){ let t; return (...a)=>{ clearTimeout(t); t=setTimeout(()=>fn(...a),ms); }; }

  const taBenef    = document.getElementById('ta_beneficios');
  const chipsBenef = document.getElementById('chips_beneficios');
  const taPerfil   = document.getElementById('ta_perfil');
  const chipsPerfil= document.getElementById('chips_perfil');

  taBenef && taBenef.addEventListener('input', debounced(()=>buildChips(taBenef, chipsBenef)));
  taPerfil && taPerfil.addEventListener('input', debounced(()=>buildChips(taPerfil, chipsPerfil)));

  // Preview lateral
  const prevUbicacion = document.getElementById('prevUbicacion');
  const prevCategoria = document.getElementById('prevCategoria');
  const prevCargo     = document.getElementById('prevCargo');
  const prevTipo      = document.getElementById('prevTipo');
  const prevExp       = document.getElementById('prevExp');
  const prevSalario   = document.getElementById('prevSalario');

  const tipoSel = document.getElementById('tipo_contratacion');
  const sexoSel = document.getElementById('sexo');
  const edadSel = document.getElementById('rango_edad');
  const expInp  = document.getElementById('experiencia');
  const salInp  = document.getElementById('salario');

  function actualizarPreview(){
    prevUbicacion && (prevUbicacion.textContent = (selCiudad.value? selCiudad.value+', ' : '') + (selDepto.value||'—'));
    prevCategoria && (prevCategoria.textContent = categoriaSelect.value || '—');
    prevCargo && (prevCargo.textContent = cargoSelect.value || '—');
    prevTipo && (prevTipo.textContent = tipoSel.value || '—');
    prevExp && (prevExp.textContent = expInp.value ? (expInp.value + ' año(s)') : '—');
    prevSalario && (prevSalario.textContent = salInp.value || '—');
  }
  ;[tipoSel, sexoSel, edadSel, expInp, salInp].forEach(el=>{
    el && el.addEventListener('input', actualizarPreview);
    el && el.addEventListener('change', actualizarPreview);
  });

  // Progreso
  const requiredSelectors = ['#actividad','#categoria','#cargo','#departamento','#ciudad'];
  const progressBar = document.getElementById('progressBar');
  const progressPct = document.getElementById('progressPct');

  function updateProgress(){
    const total = requiredSelectors.length;
    const done = requiredSelectors.reduce((acc, sel)=>{
      const el = document.querySelector(sel);
      if(!el) return acc;
      const val = (el.value||'').trim();
      return acc + (val && !el.disabled ? 1 : 0);
    },0);
    const pct = Math.round((done/total)*100);
    if(progressBar) progressBar.style.width = pct+'%';
    if(progressPct) progressPct.textContent = pct+'%';
  }
  function validacionBasica(){
    return requiredSelectors.every(sel=>{
      const el = document.querySelector(sel);
      return el && !el.disabled && (el.value||'').trim();
    });
  }

  // Init
  document.addEventListener('DOMContentLoaded', ()=>{
    buildChips(taBenef, chipsBenef);
    buildChips(taPerfil, chipsPerfil);
    actualizarPreview();
    updateProgress();
  });
  </script>
  @endpush

@endsection



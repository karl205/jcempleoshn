@extends('layouts.admin')

@section('content')
@php
  // Valores de ejemplo para precargar (en producción vendrán del controlador)
  $plaza = [
    'actividad' => 'desarrollo',           // desarrollo | creativo | finanzas | soporte | administracion
    'categoria' => 'Frontend',
    'cargo' => 'Programador Web',          // debe existir en el mapa de cargosPorCategoria
    'departamento' => 'Francisco Morazán',
    'ciudad' => 'Tegucigalpa',
    'nivel_estudio' => ['Universitario','Carreras afines'],
    'areas_estudio' => ['Ingeniería de Sistemas','Ciencias de la Computación'],
    'beneficios' => ['Vacaciones pagadas','Bonos por desempeño'],
    'tipo_contratacion' => 'permanente',   // permanente | temporal
    'sexo' => 'Indistinto',                // Indistinto | Masculino | Femenino
    'rango_edad' => '26 - 35 años',
    'experiencia' => 2,
    'salario' => 'L 25,000',
    'perfil' => 'Profesional con experiencia en desarrollo web fullstack...'
  ];
@endphp

<h2 class="mb-4 text-primary">Editar Plaza</h2>

<form action="#" method="POST">
  @csrf

  <!-- Información básica -->
  <div class="card shadow-sm mb-4">
    <div class="card-header bg-dark text-white">
      Información Básica
    </div>
    <div class="card-body row g-3">

      <!-- Actividad laboral -->
      <div class="col-md-4">
        <label class="form-label">Actividad laboral</label>
        <select class="form-select" id="actividad" name="actividad"
                data-actividad-actual="{{ $plaza['actividad'] }}">
          <option selected disabled>Seleccione una actividad</option>
          <option value="desarrollo">Desarrollo de software</option>
          <option value="creativo">Creativo/Diseño</option>
          <option value="finanzas">Finanzas/Contabilidad</option>
          <option value="soporte">Soporte/Infraestructura</option>
          <option value="administracion">Administración</option>
        </select>
      </div>

      <!-- Categoría (depende de actividad) -->
      <div class="col-md-4">
        <label class="form-label">Categoría</label>
        <select class="form-select" id="categoria" name="categoria"
                data-categoria-actual="{{ $plaza['categoria'] }}" disabled>
          <option selected disabled>Seleccione una categoría</option>
        </select>
      </div>

      <!-- Cargo (depende de categoría) -->
      <div class="col-md-4">
        <label class="form-label">Cargo</label>
        <select class="form-select" id="cargo" name="cargo"
                data-cargo-actual="{{ $plaza['cargo'] }}" disabled>
          <option selected disabled>Seleccione un cargo</option>
        </select>
      </div>

      <!-- Departamento -->
      <div class="col-md-6">
        <label class="form-label">Departamento</label>
        <select class="form-select" id="departamento" name="departamento">
          <option disabled {{ $plaza['departamento'] ? '' : 'selected' }}>Selecciona un departamento</option>
          <option value="Francisco Morazán" {{ $plaza['departamento']=='Francisco Morazán' ? 'selected' : '' }}>Francisco Morazán</option>
          <option value="Cortés" {{ $plaza['departamento']=='Cortés' ? 'selected' : '' }}>Cortés</option>
          <option value="Olancho" {{ $plaza['departamento']=='Olancho' ? 'selected' : '' }}>Olancho</option>
        </select>
      </div>

      <!-- Ciudad (depende de departamento) -->
      <div class="col-md-6">
        <label class="form-label">Ciudad</label>
        <select class="form-select" id="ciudad" name="ciudad"
                data-ciudad-actual="{{ $plaza['ciudad'] }}">
          <option selected disabled>Selecciona una ciudad</option>
        </select>
      </div>

    </div>
  </div>

  <!-- Detalle de la plaza -->
  <div class="card shadow-sm mb-4">
    <div class="card-header bg-secondary text-white">
      Detalles de la Plaza
    </div>
    <div class="card-body row g-3">

      <!-- Nivel de estudio -->
      <div class="col-md-6">
        <label class="form-label">Nivel de Estudio</label>
        <select class="form-select" name="nivel_estudio[]" multiple style="height: 150px;">
          @foreach (['Bachillerato','Técnico','Universitario','Postgrado','Maestría','Carreras afines','Doctorado','Especialización','Diplomado','Certificación técnica'] as $n)
            <option {{ in_array($n, $plaza['nivel_estudio']) ? 'selected' : '' }}>{{ $n }}</option>
          @endforeach
        </select>
      </div>

      <!-- Áreas de estudio (NUEVO) -->
      <div class="col-md-6">
        <label class="form-label">Áreas de Estudio</label>
        <select class="form-select" name="areas_estudio[]" multiple style="height: 150px;">
          @foreach (['Ingeniería de Sistemas','Ciencias de la Computación','Diseño Gráfico','Administración de Empresas','Contaduría','Finanzas','Telecomunicaciones','Redes y Seguridad','Mercadeo','Recursos Humanos'] as $a)
            <option {{ in_array($a, $plaza['areas_estudio']) ? 'selected' : '' }}>{{ $a }}</option>
          @endforeach
        </select>
      </div>

      <!-- Beneficios -->
      <div class="col-md-6">
        <label class="form-label">Beneficios</label>
        <select class="form-select" name="beneficios[]" multiple style="height: 150px;">
          @foreach (['Seguro médico','Vacaciones pagadas','Bonos por desempeño','Trabajo remoto','Horario flexible','Capacitación continua','Días personales','Seguro de vida','Transporte subsidiado','Almuerzos incluidos','Gimnasio corporativo','Opción a crecimiento'] as $b)
            <option {{ in_array($b, $plaza['beneficios']) ? 'selected' : '' }}>{{ $b }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label">Tipo de Contratación</label>
        <select class="form-select" name="tipo_contratacion">
          <option disabled {{ $plaza['tipo_contratacion'] ? '' : 'selected' }}>Selecciona una opción</option>
          <option value="permanente" {{ $plaza['tipo_contratacion']=='permanente' ? 'selected' : '' }}>Permanente</option>
          <option value="temporal" {{ $plaza['tipo_contratacion']=='temporal' ? 'selected' : '' }}>Temporal</option>
        </select>
      </div>

      <div class="col-md-3">
        <label class="form-label">Sexo</label>
        <select class="form-select" name="sexo">
          <option {{ $plaza['sexo']=='Indistinto' ? 'selected' : '' }}>Indistinto</option>
          <option {{ $plaza['sexo']=='Masculino' ? 'selected' : '' }}>Masculino</option>
          <option {{ $plaza['sexo']=='Femenino' ? 'selected' : '' }}>Femenino</option>
        </select>
      </div>

      <div class="col-md-3">
        <label class="form-label">Rango de Edad</label>
        <select class="form-select" name="rango_edad">
          <option disabled {{ $plaza['rango_edad'] ? '' : 'selected' }}>Selecciona una opción</option>
          <option {{ $plaza['rango_edad']=='18 - 25 años' ? 'selected' : '' }}>18 - 25 años</option>
          <option {{ $plaza['rango_edad']=='26 - 35 años' ? 'selected' : '' }}>26 - 35 años</option>
          <option {{ $plaza['rango_edad']=='36 - 45 años' ? 'selected' : '' }}>36 - 45 años</option>
          <option {{ $plaza['rango_edad']=='46 o más' ? 'selected' : '' }}>46 o más</option>
        </select>
      </div>

      <div class="col-md-3">
        <label class="form-label">Años de Experiencia</label>
        <input type="number" class="form-control" name="experiencia" min="0" value="{{ $plaza['experiencia'] }}">
      </div>

      <div class="col-md-3">
        <label class="form-label">Salario estimado</label>
        <input type="text" class="form-control" name="salario" value="{{ $plaza['salario'] }}">
      </div>

      <div class="col-12">
        <label class="form-label">Perfil del Puesto</label>
        <textarea class="form-control" name="perfil" rows="4">{{ $plaza['perfil'] }}</textarea>
      </div>
    </div>
  </div>

  <div class="d-grid">
    <button type="button" class="btn btn-primary btn-lg" onclick="simularActualizacion()">Actualizar Plaza</button>
  </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// --- Dependencias Departamento -> Ciudad ---
const ciudadesPorDepartamento = {
  'Francisco Morazán': ['Tegucigalpa', 'Comayagüela', 'Valle de Ángeles'],
  'Cortés': ['San Pedro Sula', 'Puerto Cortés', 'La Lima'],
  'Olancho': ['Juticalpa', 'Catacamas', 'La Unión']
};

function poblarCiudades() {
  const dep = document.getElementById('departamento');
  const ciu = document.getElementById('ciudad');
  const actual = ciu.dataset.ciudadActual || '';
  const lista = ciudadesPorDepartamento[dep.value] || [];
  ciu.innerHTML = '<option disabled>Selecciona una ciudad</option>';
  lista.forEach(c => {
    const opt = document.createElement('option');
    opt.value = c; opt.text = c;
    if (c === actual) opt.selected = true;
    ciu.appendChild(opt);
  });
  ciu.disabled = lista.length === 0;
}

// --- Dependencias Actividad -> Categoría -> Cargo ---
const categoriasPorActividad = {
  'desarrollo': ['Backend', 'Frontend', 'Full Stack', 'QA/Testing'],
  'creativo': ['Diseño Gráfico', 'UI/UX', 'Multimedia'],
  'finanzas': ['Contabilidad', 'Tesorería', 'Auditoría'],
  'soporte': ['Mesa de Ayuda', 'Redes', 'Seguridad'],
  'administracion': ['Asistencia', 'Coordinación', 'Gerencia']
};

const cargosPorCategoria = {
  'Backend': ['Programador PHP', 'Programador .NET', 'Desarrollador Java'],
  'Frontend': ['Desarrollador React', 'Desarrollador Vue', 'Maquetador', 'Programador Web'],
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

function poblarCategorias() {
  const act = document.getElementById('actividad');
  const cat = document.getElementById('categoria');
  const cargo = document.getElementById('cargo');
  const catActual = cat.dataset.categoriaActual || '';

  const lista = categoriasPorActividad[act.value] || [];
  cat.innerHTML = '<option selected disabled>Seleccione una categoría</option>';
  lista.forEach(c => {
    const opt = document.createElement('option');
    opt.value = c; opt.text = c;
    if (c === catActual) opt.selected = true;
    cat.appendChild(opt);
  });

  cat.disabled = lista.length === 0;
  // Reset cargo cuando cambia actividad
  cargo.innerHTML = '<option selected disabled>Seleccione un cargo</option>';
  cargo.disabled = true;
}

function poblarCargos() {
  const cat = document.getElementById('categoria');
  const cargo = document.getElementById('cargo');
  const cargoActual = cargo.dataset.cargoActual || '';

  const lista = cargosPorCategoria[cat.value] || [];
  cargo.innerHTML = '<option selected disabled>Seleccione un cargo</option>';
  lista.forEach(c => {
    const opt = document.createElement('option');
    opt.value = c; opt.text = c;
    if (c === cargoActual) opt.selected = true;
    cargo.appendChild(opt);
  });
  cargo.disabled = lista.length === 0;
}

document.addEventListener('DOMContentLoaded', () => {
  // Inicializar ciudades acorde al departamento ya seleccionado
  poblarCiudades();

  // Inicializar cadena Actividad -> Categoría -> Cargo con los valores actuales
  const act = document.getElementById('actividad');
  const actActual = act.dataset.actividadActual || '';
  if (actActual) {
    act.value = actActual;
  }
  poblarCategorias();   // pobla categorías y preselecciona si aplica
  poblarCargos();       // pobla cargos y preselecciona si aplica
});

document.getElementById('departamento').addEventListener('change', poblarCiudades);
document.getElementById('actividad').addEventListener('change', poblarCategorias);
document.getElementById('categoria').addEventListener('change', poblarCargos);

// SweetAlert simulación
function simularActualizacion() {
  Swal.fire({
    title: '¡Actualización exitosa!',
    text: 'La plaza ha sido actualizada correctamente.',
    icon: 'success',
    confirmButtonColor: '#0d6efd',
    timer: 2000,
    timerProgressBar: true,
  }).then(() => {
    window.location.href = "{{ route('admin.plazas') }}";
  });
}
</script>
@endsection


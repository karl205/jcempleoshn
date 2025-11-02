<style>
  .experiencia-item-bordered {
    border: 1px solid rgb(30, 30, 30);
    border-left: 6px solid rgb(30, 30, 30);
    border-radius: 0.5rem;
    position: relative;
    padding-bottom: 2.2rem; /* deja espacio para el badge */
  }
  .experiencia-title {
    display: inline-block;
    padding: .35rem .75rem;
    border-radius: .5rem;
    background: #374151;
    color: #fff;
    font-weight: 600;
    font-size: .95rem;
    line-height: 1;
    margin-bottom: 1rem;
    box-shadow: 0 2px 8px rgba(0,0,0,.08);
  }
  /* SIEMPRE visible en la 1 */
  .badge-actual {
    position: absolute;
    right: .75rem;
    bottom: .5rem;
    background: #198754;
    color: #fff;
    font-weight: 600;
    font-size: .8rem;
    padding: .35rem .6rem;
    border-radius: .5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,.08);
    display: inline-block !important; /* <-- fuerza visible */
    z-index: 1;
  }
</style>



<p class="text-muted mb-3">
    Describe tus últimos 3 trabajos de más antiguo a más reciente.
</p>

<form id="experiencia-form">
  <div id="experiencias-wrapper">

    {{-- Experiencia 1 --}}
<div class="experiencia-item experiencia-item-bordered p-3 mb-3">
  <div class="experiencia-title">Experiencia 1</div>
  <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-experiencia" aria-label="Eliminar"></button>

  <!-- Badge inferior derecho SIEMPRE visible -->
  <span id="exp1-badge" class="badge-actual" style="display:inline-block">Actualmente trabajo aquí</span>

  <div class="row g-3">
    <div class="col-md-6">
      <label>Nombre del patrono</label>
      <input type="text" class="form-control" value="Empresa XYZ S.A.">
    </div>
    <div class="col-md-6">
      <label>País</label>
      <select class="form-select">
        <option selected>Honduras</option>
        <option>El Salvador</option>
        <option>Guatemala</option>
      </select>
    </div>
    <div class="col-md-6">
      <label>Cargo</label>
      <input type="text" class="form-control" value="Asistente administrativo">
    </div>
    <div class="col-md-3">
      <label>Desde</label>
      <input type="month" class="form-control" value="2020-01">
    </div>
    <div class="col-md-3">
      <label>Hasta</label>
      <input id="exp1-hasta" type="month" class="form-control" value="">
    </div>
    <div class="col-md-6">
      <label>Actividad de trabajo</label>
      <select class="form-select">
        <option selected>Atención al cliente</option>
        <option>Producción</option>
        <option>Ventas</option>
      </select>
    </div>
    <div class="col-md-6">
      <label>Categoría laboral</label>
      <select class="form-select">
        <option selected>Administración</option>
        <option>Técnico</option>
        <option>Operativo</option>
      </select>
    </div>
    <div class="col-md-6">
      <label>Cargo (según categoría)</label>
      <select class="form-select">
        <option disabled selected>Selecciona un cargo</option>
      </select>
    </div>
  </div>
</div>



    {{-- Experiencia 2 --}}
    <div class="experiencia-item experiencia-item-bordered p-3 mb-3">
      <div class="experiencia-title">Experiencia 2</div>
      <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-experiencia" aria-label="Eliminar"></button>
      <div class="row g-3">
        <!-- Campos -->
        <div class="col-md-6">
          <label>Nombre del patrono</label>
          <input type="text" class="form-control" value="Supermercado La Central">
        </div>
        <div class="col-md-6">
          <label>País</label>
          <select class="form-select">
            <option>Honduras</option>
            <option selected>El Salvador</option>
            <option>Guatemala</option>
          </select>
        </div>
        <div class="col-md-6">
          <label>Cargo</label>
          <input type="text" class="form-control" value="Cajero">
        </div>
        <div class="col-md-3">
          <label>Desde</label>
          <input type="month" class="form-control" value="2018-06">
        </div>
        <div class="col-md-3">
          <label>Hasta</label>
          <input type="month" class="form-control" value="2020-03">
        </div>
        <div class="col-md-6">
          <label>Actividad de trabajo</label>
          <select class="form-select">
            <option selected>Ventas</option>
            <option>Atención al cliente</option>
            <option>Producción</option>
          </select>
        </div>
        <div class="col-md-6">
          <label>Categoría laboral</label>
          <select class="form-select">
            <option>Administración</option>
            <option selected>Operativo</option>
            <option>Técnico</option>
          </select>
        </div>
        <div class="col-md-6">
          <label>Cargo (según categoría)</label>
          <select class="form-select">
            <option disabled selected>Selecciona un cargo</option>
          </select>
        </div>
      </div>
    </div>
  </div>

  <!-- Botón -->
  <div class="text-end">
    <button type="button" id="add-experiencia" class="btn btn-outline-primary btn-sm">
      <i class="bi bi-plus-circle"></i> Agregar experiencia
    </button>
  </div>
</form>

<!-- Plantilla oculta -->
<div id="experiencia-template" class="d-none">
  <div class="experiencia-item experiencia-item-bordered p-3 mb-3">
    <div class="experiencia-title">Experiencia X</div>
    <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-experiencia" aria-label="Eliminar"></button>
    <div class="row g-3">
      <!-- Campos vacíos -->
      <div class="col-md-6">
        <label>Nombre del patrono</label>
        <input type="text" class="form-control">
      </div>
      <div class="col-md-6">
        <label>País</label>
        <select class="form-select">
          <option selected disabled>Selecciona país</option>
          <option>Honduras</option>
          <option>El Salvador</option>
          <option>Guatemala</option>
        </select>
      </div>
      <div class="col-md-6">
        <label>Cargo que operaba</label>
        <input type="text" class="form-control">
      </div>
      <div class="col-md-3">
        <label>Desde</label>
        <input type="month" class="form-control">
      </div>
      <div class="col-md-3">
        <label>Hasta</label>
        <input type="month" class="form-control">
      </div>
      <div class="col-md-6">
        <label>Actividad de trabajo</label>
        <select class="form-select">
          <option selected disabled>Selecciona...</option>
          <option>Atención al cliente</option>
          <option>Producción</option>
          <option>Ventas</option>
        </select>
      </div>
      <div class="col-md-6">
        <label>Categoría laboral</label>
        <select class="form-select">
          <option selected disabled>Selecciona...</option>
          <option>Administración</option>
          <option>Técnico</option>
          <option>Operativo</option>
        </select>
      </div>
      <div class="col-md-6">
        <label>Cargo (según categoría)</label>
        <select class="form-select">
          <option disabled selected>Selecciona un cargo</option>
        </select>
      </div>
    </div>
  </div>
</div>

<script>
  // Muestra el badge "Actualmente trabajo aquí" solo si el mes "Hasta" == mes actual (yyyy-mm)
  (function(){
    const hasta = document.getElementById('exp1-hasta');
    const badge = document.getElementById('exp1-badge');

    function esMesActual(valor) {
      if (!valor) return false;
      const hoy = new Date();
      const yyyy = hoy.getFullYear();
      const mm = String(hoy.getMonth() + 1).padStart(2, '0');
      return valor === `${yyyy}-${mm}`;
    }

    function actualizarBadge() {
      badge.style.display = esMesActual(hasta.value) ? 'inline-block' : 'none';
    }

    // Inicializa al cargar
    document.addEventListener('DOMContentLoaded', actualizarBadge);
    // Reacciona a cambios
    hasta.addEventListener('change', actualizarBadge);
  })();
</script>


<script>
  // Lógica del switch para Experiencia 1
  (function() {
    const sw = document.getElementById('exp1-actual-switch');
    const hasta = document.getElementById('exp1-hasta');
    const badge = document.getElementById('exp1-badge');

    // Estado inicial: si no hay "Hasta" o está vacío => marcar como actual
    const iniciarComoActual = !hasta.value;
    if (iniciarComoActual) {
      sw.checked = true;
    }

    function actualizarEstado() {
      const activo = sw.checked;
      badge.style.display = activo ? 'inline-block' : 'none';
      hasta.disabled = activo;
      if (activo) {
        hasta.value = ''; // opcional: limpiar "Hasta" si lo marcas como actual
      }
    }

    sw.addEventListener('change', actualizarEstado);
    // Inicializar
    actualizarEstado();
  })();
</script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        let experienciaCount = 2;

        function actualizarTitulos() {
            document.querySelectorAll('.experiencia-item').forEach((item, i) => {
                const title = item.querySelector('.experiencia-title');
                if (title) {
                    title.textContent = `Experiencia ${i + 1}`;
                }
            });
        }

        document.getElementById('add-experiencia').addEventListener('click', () => {
            if (experienciaCount >= 3) return;

            const template = document.getElementById('experiencia-template').innerHTML;
            const wrapper = document.getElementById('experiencias-wrapper');
            wrapper.insertAdjacentHTML('beforeend', template);
            experienciaCount++;

            actualizarTitulos();

            if (experienciaCount >= 3) {
                document.getElementById('add-experiencia').disabled = true;
            }
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-experiencia')) {
                const tarjeta = e.target.closest('.experiencia-item');

                Swal.fire({
                    title: '¿Eliminar experiencia laboral?',
                    text: 'Esta acción no se puede deshacer.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        tarjeta.remove();
                        experienciaCount--;

                        actualizarTitulos();

                        if (experienciaCount < 3) {
                            document.getElementById('add-experiencia').disabled = false;
                        }

                        Swal.fire({
                            title: 'Eliminado',
                            text: 'La experiencia ha sido eliminada.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                });
            }
        });

        // Inicial
        actualizarTitulos();
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



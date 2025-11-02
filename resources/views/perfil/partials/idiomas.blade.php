<style>
  .idioma-item-bordered {
      border: 1px solid rgb(30, 30, 30);
      border-left: 6px solid rgb(30, 30, 30);
      border-radius: 0.5rem;
      position: relative;
  }
  .idioma-title{
      display:inline-block;
      padding:.35rem .75rem;
      border-radius:.5rem;
      background:#374151;   /* gris oscuro elegante */
      color:#fff;
      font-weight:600;
      font-size:.95rem;
      margin-bottom:1rem;
      box-shadow:0 2px 8px rgba(0,0,0,.08);
  }
</style>

<p class="text-muted mb-3">
  ¿Qué idiomas dominas?
</p>

<form id="idiomas-form">
  <div id="idiomas-wrapper">
    {{-- Idioma 1 --}}
    <div class="idioma-item idioma-item-bordered p-3 mb-3">
      <div class="idioma-title">Idioma 1</div>
      <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-idioma" aria-label="Eliminar"></button>
      <div class="row g-3 align-items-end">
        <div class="col-md-6">
          <label>Idioma</label>
          <select class="form-select">
            <option selected>Español</option>
            <option>Inglés</option>
            <option>Francés</option>
            <option>Alemán</option>
          </select>
        </div>
        <div class="col-md-6">
          <label>Nivel</label>
          <select class="form-select">
            <option>Básico</option>
            <option selected>Intermedio</option>
            <option>Avanzado</option>
          </select>
        </div>
      </div>
    </div>

    {{-- Idioma 2 --}}
    <div class="idioma-item idioma-item-bordered p-3 mb-3">
      <div class="idioma-title">Idioma 2</div>
      <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-idioma" aria-label="Eliminar"></button>
      <div class="row g-3 align-items-end">
        <div class="col-md-6">
          <label>Idioma</label>
          <select class="form-select">
            <option>Español</option>
            <option selected>Inglés</option>
            <option>Francés</option>
            <option>Alemán</option>
          </select>
        </div>
        <div class="col-md-6">
          <label>Nivel</label>
          <select class="form-select">
            <option>Básico</option>
            <option>Intermedio</option>
            <option selected>Avanzado</option>
          </select>
        </div>
      </div>
    </div>
  </div>

  <div class="text-end">
    <button type="button" id="add-idioma" class="btn btn-outline-success btn-sm">
      <i class="bi bi-plus-circle"></i> Agregar otro idioma
    </button>
  </div>
</form>

<div id="idioma-template" class="d-none">
  <div class="idioma-item idioma-item-bordered p-3 mb-3">
    <div class="idioma-title">Idioma X</div>
    <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-idioma" aria-label="Eliminar"></button>
    <div class="row g-3 align-items-end">
      <div class="col-md-6">
        <label>Idioma</label>
        <select class="form-select">
          <option selected disabled>Selecciona...</option>
          <option>Español</option>
          <option>Inglés</option>
          <option>Francés</option>
          <option>Alemán</option>
        </select>
      </div>
      <div class="col-md-6">
        <label>Nivel</label>
        <select class="form-select">
          <option selected disabled>Selecciona...</option>
          <option>Básico</option>
          <option>Intermedio</option>
          <option>Avanzado</option>
        </select>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    let idiomaCount = 2;

    function renumerarTitulos(){
      document.querySelectorAll('.idioma-item').forEach((item, i) => {
        const t = item.querySelector('.idioma-title');
        if (t) t.textContent = `Idioma ${i + 1}`;
      });
    }

    document.getElementById('add-idioma').addEventListener('click', () => {
      if (idiomaCount >= 3) return;

      const template = document.getElementById('idioma-template').innerHTML;
      const wrapper = document.getElementById('idiomas-wrapper');
      wrapper.insertAdjacentHTML('beforeend', template);

      idiomaCount++;
      renumerarTitulos();

      const ult = document.querySelectorAll('.idioma-item');
      ult[ult.length - 1].scrollIntoView({ behavior: 'smooth', block: 'center' });

      if (idiomaCount >= 3) {
        document.getElementById('add-idioma').disabled = true;
      }
    });

    document.addEventListener('click', function (e) {
      if (e.target.classList.contains('remove-idioma')) {
        const tarjeta = e.target.closest('.idioma-item');

        Swal.fire({
          title: '¿Estás seguro?',
          text: "Esta acción eliminará el idioma seleccionado.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Sí, eliminar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            tarjeta.remove();
            idiomaCount--;
            renumerarTitulos();

            if (idiomaCount < 3) {
              document.getElementById('add-idioma').disabled = false;
            }

            Swal.fire({
              title: 'Eliminado',
              text: 'El idioma ha sido eliminado.',
              icon: 'success',
              timer: 1500,
              showConfirmButton: false
            });
          }
        });
      }
    });

    // Inicial
    renumerarTitulos();
  });
</script>

<!-- CDN de SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>







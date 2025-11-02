<style>
    .formacion-item-bordered {
        border: 1px solid rgb(30, 30, 30);       /* borde negro mate delgado */
        border-left: 6px solid rgb(30, 30, 30);  /* borde izquierdo más ancho */
        border-radius: 0.5rem;
        position: relative;
    }
    .formacion-title {
        display: inline-block;
        padding: .35rem .75rem;
        border-radius: .5rem;
        background: #374151;    /* gris oscuro */
        color: #fff;            /* texto blanco */
        font-weight: 600;
        font-size: .95rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,.08);
    }
</style>

<p class="text-muted mb-3">
    Ingresa tu información educativa de más antiguo a más reciente.
</p>

<form id="formacion-form">
    <div id="formaciones-wrapper">

        {{-- Formación 1 --}}
        <div class="formacion-item formacion-item-bordered p-3 mb-3 position-relative">
            <div class="formacion-title">Formación 1</div>
            <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-formacion" aria-label="Eliminar"></button>

            <div class="row g-3">
                <div class="col-md-6">
                    <label>Nombre de la institución</label>
                    <input type="text" class="form-control" value="Universidad Nacional Autónoma de Honduras">
                </div>
                <div class="col-md-3">
                    <label>Desde</label>
                    <input type="month" class="form-control" value="2018-01">
                </div>
                <div class="col-md-3">
                    <label>Hasta</label>
                    <input type="month" class="form-control" value="2022-11">
                </div>
                <div class="col-md-4">
                    <label>Nivel educativo</label>
                    <select class="form-select">
                        <option>Bachillerato</option>
                        <option selected>Universitario</option>
                        <option>Maestría</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Área de estudio</label>
                    <select class="form-select">
                        <option selected>Ingeniería</option>
                        <option>Administración</option>
                        <option>Educación</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>País</label>
                    <select class="form-select">
                        <option>Honduras</option>
                        <option selected>El Salvador</option>
                        <option>Guatemala</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Formación 2 --}}
        <div class="formacion-item formacion-item-bordered p-3 mb-3 position-relative">
            <div class="formacion-title">Formación 2</div>
            <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-formacion" aria-label="Eliminar"></button>

            <div class="row g-3">
                <div class="col-md-6">
                    <label>Nombre de la institución</label>
                    <input type="text" class="form-control" value="Instituto Técnico Honduras">
                </div>
                <div class="col-md-3">
                    <label>Desde</label>
                    <input type="month" class="form-control" value="2015-02">
                </div>
                <div class="col-md-3">
                    <label>Hasta</label>
                    <input type="month" class="form-control" value="2017-10">
                </div>
                <div class="col-md-4">
                    <label>Nivel educativo</label>
                    <select class="form-select">
                        <option selected>Técnico</option>
                        <option>Universitario</option>
                        <option>Maestría</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Área de estudio</label>
                    <select class="form-select">
                        <option selected>Administración</option>
                        <option>Ingeniería</option>
                        <option>Educación</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>País</label>
                    <select class="form-select">
                        <option selected>Honduras</option>
                        <option>El Salvador</option>
                        <option>Guatemala</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón -->
    <div class="text-end">
        <button type="button" id="add-formacion" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Agregar formación
        </button>
    </div>
</form>

<!-- Plantilla oculta -->
<div id="formacion-template" class="d-none">
    <div class="formacion-item formacion-item-bordered p-3 mb-3 position-relative">
        <div class="formacion-title">Formación X</div>
        <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-formacion" aria-label="Eliminar"></button>

        <div class="row g-3">
            <div class="col-md-6">
                <label>Nombre de la institución</label>
                <input type="text" class="form-control" placeholder="Ej: Universidad Nacional">
            </div>
            <div class="col-md-3">
                <label>Desde</label>
                <input type="month" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Hasta</label>
                <input type="month" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Nivel educativo</label>
                <select class="form-select">
                    <option>Selecciona...</option>
                    <option>Bachillerato</option>
                    <option>Técnico</option>
                    <option>Universitario</option>
                    <option>Maestría</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>Área de estudio</label>
                <select class="form-select">
                    <option>Selecciona...</option>
                    <option>Administración</option>
                    <option>Ingeniería</option>
                    <option>Educación</option>
                    <option>Salud</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>País</label>
                <select class="form-select">
                    <option>Selecciona...</option>
                    <option>Honduras</option>
                    <option>El Salvador</option>
                    <option>Guatemala</option>
                    <option>Otro</option>
                </select>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    let formacionCount = 2;

    function actualizarTitulos() {
        document.querySelectorAll('.formacion-item').forEach((item, i) => {
            const title = item.querySelector('.formacion-title');
            if (title) {
                title.textContent = `Formación ${i + 1}`;
            }
        });
    }

    document.getElementById('add-formacion').addEventListener('click', () => {
        if (formacionCount >= 3) return;

        const template = document.getElementById('formacion-template').innerHTML;
        const wrapper = document.getElementById('formaciones-wrapper');
        wrapper.insertAdjacentHTML('beforeend', template);
        formacionCount++;

        actualizarTitulos();

        if (formacionCount >= 3) {
            document.getElementById('add-formacion').disabled = true;
        }
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-formacion')) {
            const tarjeta = e.target.closest('.formacion-item');

            Swal.fire({
                title: '¿Eliminar formación académica?',
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
                    formacionCount--;

                    actualizarTitulos();

                    if (formacionCount < 3) {
                        document.getElementById('add-formacion').disabled = false;
                    }

                    Swal.fire({
                        title: 'Eliminado',
                        text: 'La formación ha sido eliminada.',
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





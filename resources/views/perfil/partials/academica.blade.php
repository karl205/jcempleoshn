<p class="text-muted mb-3">
    Ingresa tu formación académica de más antigua a más reciente.
</p>

<div id="formaciones-wrapper">

    <div class="section-card p-4 mb-3 formacion-item">
        <span class="section-title">Formación 1</span>

        <div class="row g-3">
            <div class="col-md-6">
                <label>Institución</label>
                <input type="text" name="academica[0][institucion]" class="form-control">
            </div>

            <div class="col-md-3">
                <label>Desde</label>
                <input type="month" name="academica[0][desde]" class="form-control">
            </div>

            <div class="col-md-3">
                <label>Hasta</label>
                <input type="month" name="academica[0][hasta]" class="form-control">
            </div>

            <div class="col-md-6">
                <label>Nivel educativo</label>
                <select name="academica[0][nivel]" class="form-select">
                    <option>Bachillerato</option>
                    <option>Técnico</option>
                    <option>Universitario</option>
                    <option>Maestría</option>
                </select>
            </div>

            <div class="col-md-6">
                <label>Área de estudio</label>
                <input type="text" name="academica[0][area]" class="form-control">
            </div>
        </div>
    </div>

</div>

<div class="text-end">
    <button type="button" id="add-formacion" class="btn btn-outline-primary btn-sm">
        <i class="bi bi-plus-circle"></i> Agregar formación
    </button>
</div>

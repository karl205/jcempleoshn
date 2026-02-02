<p class="text-muted mb-3">
    Describe tus últimos empleos.
</p>

<div id="experiencias-wrapper">

    <div class="section-card p-4 mb-3 experiencia-item">
        <span class="section-title">Experiencia 1</span>

        <div class="row g-3">
            <div class="col-md-6">
                <label>Empresa</label>
                <input type="text" name="experiencia[0][empresa]" class="form-control">
            </div>

            <div class="col-md-6">
                <label>País</label>
                <input type="text" name="experiencia[0][pais]" class="form-control">
            </div>

            <div class="col-md-6">
                <label>Cargo</label>
                <input type="text" name="experiencia[0][cargo]" class="form-control">
            </div>

            <div class="col-md-3">
                <label>Desde</label>
                <input type="month" name="experiencia[0][desde]" class="form-control">
            </div>

            <div class="col-md-3">
                <label>Hasta</label>
                <input type="month" name="experiencia[0][hasta]" class="form-control">
            </div>

            <div class="col-12">
                <label>Descripción</label>
                <textarea name="experiencia[0][descripcion]" class="form-control" rows="3"></textarea>
            </div>
        </div>
    </div>

</div>

<div class="text-end">
    <button type="button" id="add-experiencia" class="btn btn-outline-primary btn-sm">
        <i class="bi bi-plus-circle"></i> Agregar experiencia
    </button>
</div>

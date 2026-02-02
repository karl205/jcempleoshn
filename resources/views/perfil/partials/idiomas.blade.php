<p class="text-muted mb-3">
    Indica los idiomas que dominas.
</p>

<div id="idiomas-wrapper">

    <div class="section-card p-4 mb-3 idioma-item">
        <span class="section-title">Idioma 1</span>

        <div class="row g-3">
            <div class="col-md-6">
                <label>Idioma</label>
                <select name="idiomas[0][idioma]" class="form-select">
                    <option>Español</option>
                    <option>Inglés</option>
                    <option>Francés</option>
                    <option>Alemán</option>
                </select>
            </div>

            <div class="col-md-6">
                <label>Nivel</label>
                <select name="idiomas[0][nivel]" class="form-select">
                    <option>Básico</option>
                    <option>Intermedio</option>
                    <option>Avanzado</option>
                </select>
            </div>
        </div>
    </div>

</div>

<div class="text-end">
    <button type="button" id="add-idioma" class="btn btn-outline-primary btn-sm">
        <i class="bi bi-plus-circle"></i> Agregar idioma
    </button>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th style="width:60px">#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th style="width:120px">Estado</th>
                        <th style="width:140px" class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Administración</td>
                        <td>Gestión administrativa y operativa</td>
                        <td>
                            <span class="badge bg-success">Activo</span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEditarCategoria">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Tecnología</td>
                        <td>Área de sistemas y desarrollo</td>
                        <td>
                            <span class="badge bg-secondary">Inactivo</span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEditarCategoria">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- MODAL CREAR -->
<div class="modal fade" id="modalCrearCategoria" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Nueva Categoría Laboral</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text"
                           class="form-control"
                           placeholder="Ej: Recursos Humanos">
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-control"
                              rows="3"
                              placeholder="Descripción breve..."></textarea>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" checked>
                    <label class="form-check-label">Activo</label>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button class="btn btn-primary">
                    Guardar
                </button>
            </div>

        </div>
    </div>
</div>

<!-- MODAL EDITAR -->
<div class="modal fade" id="modalEditarCategoria" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Editar Categoría Laboral</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text"
                           class="form-control"
                           value="Administración">
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-control"
                              rows="3">Gestión administrativa y operativa</textarea>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" checked>
                    <label class="form-check-label">Activo</label>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button class="btn btn-primary">
                    Guardar cambios
                </button>
            </div>

        </div>
    </div>
</div>



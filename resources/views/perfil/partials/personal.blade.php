<form method="POST" action="">
    @csrf

    {{-- <div class="profile-card p-4 mb-4"> --}}

        <!-- HEADER PERFIL -->
        <div class="d-flex align-items-center gap-4 mb-4">
            <img id="previewImagen"
                 src="{{ asset('assets/images/default-user.jpg') }}"
                 class="rounded-circle"
                 style="width:120px;height:120px;object-fit:cover;border:3px solid #e5e7eb">

            <div>
                <h5 class="mb-1 fw-semibold text-dark">
                    Información personal
                </h5>
                <p class="text-muted mb-2 small">
                    Estos datos se mostrarán en tu currículum
                </p>

                <label class="btn btn-outline-primary btn-sm rounded-pill">
                    Cambiar foto
                    <input type="file" name="foto" hidden>
                </label>
            </div>
        </div>

        <!-- DATOS PERSONALES -->
        <div class="section-card p-4 mb-4">
            <span class="section-title">Datos personales</span>

            <div class="row g-3">

                <div class="col-md-6">
                    <label>Nombres</label>
                    <input type="text" name="nombres" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Apellidos</label>
                    <input type="text" name="apellidos" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Fecha de nacimiento</label>
                    <input type="date" name="fecha_nacimiento" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Sexo</label>
                    <select name="sexo" class="form-select">
                        <option selected disabled>Selecciona</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                        <option value="O">Otro</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Nacionalidad</label>
                    <input type="text" name="nacionalidad" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Disponibilidad vehicular</label>
                    <select name="vehiculo" class="form-select">
                        <option selected disabled>Selecciona</option>
                        <option value="ninguno">Ninguno</option>
                        <option value="carro">Carro</option>
                        <option value="moto">Moto</option>
                    </select>
                </div>

                <div class="col-12">
                    <label>Acerca de mí</label>
                    <textarea name="acerca_de_mi" class="form-control" rows="4"></textarea>
                </div>

            </div>
        </div>

        {{-- <!-- BOTÓN GUARDAR -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success btn-guardar-perfil">
                💾 Guardar perfil
            </button>
        </div> --}}

    {{-- </div> --}}
</form>

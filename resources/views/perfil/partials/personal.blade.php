{{-- FOTO DE PERFIL --}}
<div class="d-flex align-items-center gap-4 mb-4">

    <img
        src="{{ $profile && $profile->foto
                ? asset('storage/fotos_perfil/' . $profile->foto)
                : asset('assets/images/default-user.jpg') }}"
        class="rounded-circle"
        style="width:120px;height:120px;object-fit:cover;border:3px solid #e5e7eb"
        alt="Foto de perfil">

    <div>
        <h5 class="mb-1 fw-semibold text-dark">Información personal</h5>
        <p class="text-muted mb-2 small">
            Estos datos se mostrarán en tu currículum
        </p>

        <label class="btn btn-outline-primary btn-sm rounded-pill">
            Cambiar foto
            <input type="file" name="foto" accept="image/*" hidden>
        </label>
    </div>
</div>

{{-- DATOS PERSONALES --}}
<div class="row g-3">

    <div class="col-md-6">
        <label>Nombres</label>
        <input type="text"
               name="nombres"
               class="form-control"
               value="{{ old('nombres', $profile->nombres ?? '') }}">
    </div>

    <div class="col-md-6">
        <label>Apellidos</label>
        <input type="text"
               name="apellidos"
               class="form-control"
               value="{{ old('apellidos', $profile->apellidos ?? '') }}">
    </div>

    <div class="col-md-6">
        <label>Fecha de nacimiento</label>
        <input type="date"
               name="fecha_nacimiento"
               class="form-control"
               value="{{ old('fecha_nacimiento', $profile->fecha_nacimiento ?? '') }}">
    </div>

    <div class="col-md-6">
        <label>Sexo</label>
        <select name="sexo_id" class="form-select">
            <option value="">Selecciona</option>
            @foreach ($sexos as $sexo)
                <option value="{{ $sexo->id }}"
                    @selected(old('sexo_id', $profile->sexo_id ?? '') == $sexo->id)>
                    {{ $sexo->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label>Teléfono</label>
        <input type="text"
               name="telefono"
               class="form-control"
               value="{{ old('telefono', $profile->telefono ?? '') }}">
    </div>

    <div class="col-md-6">
        <label>Nacionalidad</label>
        <select name="nacionalidad_id" class="form-select">
            <option value="">Selecciona</option>
            @foreach ($nacionalidades as $n)
                <option value="{{ $n->id }}"
                    @selected(old('nacionalidad_id', $profile->nacionalidad_id ?? '') == $n->id)>
                    {{ $n->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label>Disponibilidad vehicular</label>
        <select name="disponibilidad_vehicular_id" class="form-select">
            <option value="">Selecciona</option>
            @foreach ($vehiculos as $v)
                <option value="{{ $v->id }}"
                    @selected(old('disponibilidad_vehicular_id', $profile->disponibilidad_vehicular_id ?? '') == $v->id)>
                    {{ $v->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label>Acerca de mí</label>
        <textarea name="acerca_de_mi"
                  class="form-control"
                  rows="4">{{ old('acerca_de_mi', $profile->acerca_de_mi ?? '') }}</textarea>
    </div>

</div>

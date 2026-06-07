{{-- FOTO DE PERFIL --}}
<div class="d-flex align-items-center gap-4 mb-4">

    <img id="fotoPreview"
        src="{{ $perfil && $perfil->foto
            ? asset('storage/fotos_perfil/' . $perfil->foto)
            : asset('assets/images/default-user.jpg') }}"
        class="rounded-circle" style="width:120px;height:120px;object-fit:cover;border:3px solid #e5e7eb"
        alt="Foto de perfil">

    <div>
        <h5 class="mb-1 fw-semibold text-dark">Información personal</h5>
        <p class="text-muted mb-2 small">
            Estos datos se mostrarán en tu currículum
        </p>

        <label class="btn btn-outline-primary btn-sm rounded-pill">
            Cambiar foto
            <input type="file" name="foto" id="inputFoto" accept="image/png,image/jpeg,image/webp" hidden>
        </label>
    </div>
</div>

{{-- DATOS PERSONALES --}}
<div class="row g-3">

    {{-- NOMBRE (usuario) --}}
    <div class="col-md-6">
        <label>Nombres</label>
        <input type="text" class="form-control" value="{{ old('nombre', auth()->user()->nombre) }}" disabled>
    </div>

    {{-- APELLIDO (usuario) --}}
    <div class="col-md-6">
        <label>Apellidos</label>
        <input type="text" class="form-control" value="{{ old('apellido', auth()->user()->apellido) }}" disabled>
    </div>

    <div class="col-md-6">
        <label>País de residencia</label>
        <select name="pais_id" class="form-select">
            <option value="">Selecciona</option>
            @foreach ($paises as $pais)
                <option value="{{ $pais->id }}" @selected(old('pais_id', $perfil->pais_id ?? '') == $pais->id)>
                    {{ $pais->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
    <label>Fecha de nacimiento</label>
    <input type="date" name="fecha_nacimiento" class="form-control"
        value="{{ old('fecha_nacimiento', $perfil->fecha_nacimiento ?? '') }}"
        max="{{ date('Y-m-d') }}">
</div>

    <div class="col-md-6">
        <label>Sexo</label>
        <select name="sexo_id" class="form-select">
            <option value="">Selecciona</option>
            @foreach ($sexos as $sexo)
                <option value="{{ $sexo->id }}" @selected(old('sexo_id', $perfil->sexo_id ?? '') == $sexo->id)>
                    {{ $sexo->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label>Teléfono</label>
        <input type="text" name="telefono" class="form-control"
            value="{{ old('telefono', $perfil->telefono ?? '') }}">
    </div>

    <div class="col-md-6">
        <label>Nacionalidad</label>
        <select name="nacionalidad_id" class="form-select">
            <option value="">Selecciona</option>
            @foreach ($nacionalidades as $n)
                <option value="{{ $n->id }}" @selected(old('nacionalidad_id', $perfil->nacionalidad_id ?? '') == $n->id)>
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
                <option value="{{ $v->id }}" @selected(old('disponibilidad_vehicular_id', $perfil->disponibilidad_vehicular_id ?? '') == $v->id)>
                    {{ $v->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label>Acerca de mí</label>
        <textarea name="acerca_de_mi" class="form-control" rows="4">{{ old('acerca_de_mi', $perfil->acerca_de_mi ?? '') }}</textarea>
    </div>
</div>

<script>
    document.getElementById('inputFoto').addEventListener('change', function(e) {

        const file = e.target.files[0];
        if (!file) return;

        // 1. Tipo
        if (!file.type.startsWith('image/')) {
            alert('Selecciona una imagen válida');
            e.target.value = '';
            return;
        }

        // 2. Tamaño (5MB)
        const maxSize = 5 * 1024 * 1024;
        if (file.size > maxSize) {
            alert('La imagen no debe superar los 5 MB');
            e.target.value = '';
            return;
        }

        // 3. Dimensiones
        const img = new Image();
        const reader = new FileReader();

        reader.onload = function(event) {
            img.src = event.target.result;
        };

        img.onload = function() {
            if (img.width < 200 || img.height < 200) {
                alert('La imagen debe ser al menos de 200x200 píxeles');
                e.target.value = '';
                return;
            }

            // 4. Preview final
            document.getElementById('fotoPreview').src = img.src;
        };

        reader.readAsDataURL(file);
    });
</script>

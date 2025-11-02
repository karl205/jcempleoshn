<!-- FOTO DE PERFIL -->
<div class="text-center mb-4">
    <img id="previewImagen" src="{{ asset('assets/images/default-user.jpg') }}"
         class="rounded-circle shadow"
         style="width: 150px; height: 150px; object-fit: cover;"
         alt="Foto de perfil">
    
    <div class="mt-2">
        <label class="btn btn-outline-primary btn-sm">
            Cambiar foto
            <input type="file" id="inputFoto" accept="image/*" hidden>
        </label>
    </div>
</div>

<form>
    <div class="row g-3">
        <div class="col-md-6">
            <label>Nombres</label>
            <input type="text" class="form-control" placeholder="Escribe tus nombres">
        </div>
        <div class="col-md-6">
            <label>Apellidos</label>
            <input type="text" class="form-control" placeholder="Escribe tus apellidos">
        </div>

        <div class="col-md-6">
            <label>Fecha de nacimiento</label>
            <input type="date" class="form-control">
        </div>
        <div class="col-md-6">
            <label>Sexo</label>
            <select name="sexo" class="form-select">
                <option disabled selected>Selecciona una opción</option>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
                <option value="otro">Otro</option>
            </select>
        </div>

        <div class="col-md-6">
            <label>Teléfono</label>
            <input type="number" class="form-control" placeholder="Ingresa tu número celular">
        </div>

        {{-- 🔽 Nuevo campo: Nacionalidad --}}
        <div class="col-md-6">
            <label>Nacionalidad</label>
            <input type="text" class="form-control" placeholder="Ej. Hondureña">
        </div>

        <div class="col-md-6">
            <label>Disponibilidad vehicular</label>
            <select name="vehiculo" class="form-select">
                <option disabled selected>Selecciona una opción</option>
                <option value="ninguno">Ninguno</option>
                <option value="carro">Carro</option>
                <option value="moto">Moto</option>
            </select>
        </div>

        <div class="col-md-6">
            <label>Departamento</label>
            <select class="form-select" id="departamento">
                <option selected disabled>Selecciona un departamento</option>
                <option value="Francisco Morazán">Francisco Morazán</option>
                <option value="Cortés">Cortés</option>
                <option value="Olancho">Olancho</option>
            </select>
        </div>

        <div class="col-md-6">
            <label>Ciudad</label>
            <select class="form-select" id="ciudad" disabled>
                <option selected disabled>Selecciona una ciudad</option>
            </select>
        </div>

        <div class="col-md-6">
            <label>Aspiración salarial (L.)</label>
            <input type="number" class="form-control" placeholder="Ej. 18000">
        </div>

        {{-- 🔽 Nuevo campo: Acerca de mí --}}
        <div class="col-12">
            <label>Acerca de mí</label>
            <textarea class="form-control" rows="4" placeholder="Escribe aquí tu perfil, intereses o cualquier información que quieras compartir"></textarea>
        </div>
    </div>
</form>


<script>
    const ciudadesPorDepartamento = {
        'Francisco Morazán': ['Tegucigalpa', 'Comayagüela', 'Valle de Ángeles'],
        'Cortés': ['San Pedro Sula', 'Puerto Cortés', 'La Lima'],
        'Olancho': ['Juticalpa', 'Catacamas', 'La Unión']
    };

    document.getElementById('departamento').addEventListener('change', function () {
        const ciudadSelect = document.getElementById('ciudad');
        const ciudades = ciudadesPorDepartamento[this.value] || [];
        ciudadSelect.innerHTML = '<option selected disabled>Selecciona una ciudad</option>';
        ciudades.forEach(c => {
            const opt = document.createElement('option');
            opt.value = c;
            opt.text = c;
            ciudadSelect.appendChild(opt);
        });
        ciudadSelect.disabled = ciudades.length === 0;
    });
</script>

<script>
    document.getElementById('inputFoto').addEventListener('change', function(event) {
        const imagen = event.target.files[0];
        if (imagen) {
            const lector = new FileReader();
            lector.onload = function(e) {
                document.getElementById('previewImagen').src = e.target.result;
            }
            lector.readAsDataURL(imagen);
        }
    });
</script>

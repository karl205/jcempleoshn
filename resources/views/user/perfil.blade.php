@extends('layouts.cuenta')

@push('styles')
<style>
    .nav-tabs .nav-link {
        background-color: #e9ecef;
        color: #495057;
        border: 1px solid #dee2e6;
        margin-right: 2px;
    }

    .nav-tabs .nav-link.active {
        background-color: #ced4da;
        color: #212529;
        border-color: #dee2e6 #dee2e6 #fff;
    }

    .nav-tabs .nav-link:hover {
        background-color: #dee2e6;
        color: #212529;
    }
</style>
@endpush

@section('cuenta-content')
    <h2 class="mb-4 text-primary">Mi Perfil</h2>

    <!-- Botón Generar Currículum -->
    <div class="text-end mb-3">
        <button id="btn-generar-cv" class="btn btn-outline-success">
            <span id="cv-icon"><i class="bi bi-file-earmark-arrow-down"></i></span>
            <span id="cv-loading" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            Generar Currículum
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <ul class="nav nav-tabs card-header-tabs" id="perfilTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab">Información Personal</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#academica" type="button" role="tab">Formación Académica</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#idiomas" type="button" role="tab">Idiomas</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#experiencia" type="button" role="tab">Experiencia laboral</button>
                </li>
            </ul>
        </div>

        <div class="card-body tab-content">
            <div class="tab-pane fade show active" id="personal" role="tabpanel">
                @include('perfil.partials.personal')
            </div>
            <div class="tab-pane fade" id="academica" role="tabpanel">
                @include('perfil.partials.academica')
            </div>
            <div class="tab-pane fade" id="idiomas" role="tabpanel">
                @include('perfil.partials.idiomas')
            </div>
            <div class="tab-pane fade" id="experiencia" role="tabpanel">
                @include('perfil.partials.experiencia')
            </div>
        </div>
    </div>

    <!-- CDN SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="text-end mt-4"> 
  <button id="guardarPerfilBtn" class="btn btn-success btn-sm px-4 py-2">
    💾 Guardar perfil
  </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const boton = document.getElementById('guardarPerfilBtn');
  boton.addEventListener('click', (e) => {
    // Si NO envías el formulario aquí, quita el preventDefault.
    e.preventDefault();

    // Aquí harías tu guardado (fetch/AJAX). Al terminar:
    Swal.fire({
      toast: true,
      position: 'top-end',
      icon: 'success',
      title: 'Perfil guardado y actualizado',
      showConfirmButton: false,
      timer: 2200,
      timerProgressBar: true
    });
  });
});
</script>

@endsection




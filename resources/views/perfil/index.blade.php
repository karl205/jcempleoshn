@extends('layouts.cuenta')

<script>
    //SCRIPT DE FORMACION ACADEMICA
    document.addEventListener('DOMContentLoaded', function() {

        const wrapper = document.getElementById('educations-wrapper');
        const addBtn = document.getElementById('add-education');

        addBtn.addEventListener('click', function() {
            const index = wrapper.querySelectorAll('.education-item').length;

            const template = `
            <div class="section-card p-4 mb-3 education-item">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <strong>Formación ${index + 1}</strong>
                    <button type="button" class="btn btn-outline-danger btn-sm remove-education">
                        Eliminar
                    </button>
                </div>

                <!-- FILA 1 -->
                <div class="mb-3">
                    <input type="text"
                           name="educations[${index}][institucion]"
                           class="form-control"
                           placeholder="Institución">
                </div>

                <!-- FILA 2 -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <select name="educations[${index}][nivel_educativo_id]" class="form-select">
                            <option value="">Nivel educativo</option>
                            @foreach ($niveles as $nivel)
                                <option value="{{ $nivel->id }}">{{ $nivel->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <input type="text"
                               name="educations[${index}][area_estudio]"
                               class="form-control"
                               placeholder="Área de estudio">
                    </div>
                </div>

            </div>
        `;

            wrapper.insertAdjacentHTML('beforeend', template);
        });

        wrapper.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-education')) {
                e.target.closest('.education-item').remove();
            }
        });

    });

    //SCRIPT DE IDIOMAS DINAMICOS
    document.addEventListener('DOMContentLoaded', function() {

        const wrapperLang = document.getElementById('languages-wrapper');
        const addLangBtn = document.getElementById('add-language');

        addLangBtn.addEventListener('click', function() {
            const index = wrapperLang.querySelectorAll('.language-item').length;

            const template = `
            <div class="section-card p-4 mb-3 language-item">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <strong>Idioma ${index + 1}</strong>
                    <button type="button" class="btn btn-outline-danger btn-sm remove-language">
                        Eliminar
                    </button>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <select name="languages[${index}][idioma_id]" class="form-select">
                            <option value="">Selecciona idioma</option>
                            @foreach ($idiomasCat as $idioma)
                                <option value="{{ $idioma->id }}">{{ $idioma->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <select name="languages[${index}][nivel_id]" class="form-select">
                            <option value="">Selecciona nivel</option>
                            @foreach ($nivelesIdioma as $nivel)
                                <option value="{{ $nivel->id }}">{{ $nivel->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
        `;

            wrapperLang.insertAdjacentHTML('beforeend', template);
        });

        wrapperLang.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-language')) {
                e.target.closest('.language-item').remove();
            }
        });

    });

    //SCRIPT DE EXPERIENCIA LABORAL
    document.addEventListener('DOMContentLoaded', function() {

        const wrapperExp = document.getElementById('experiences-wrapper');
        const addExpBtn = document.getElementById('add-experience');

        addExpBtn.addEventListener('click', function() {
            const index = wrapperExp.querySelectorAll('.experience-item').length;

            const template = `
            <div class="section-card p-4 mb-3 experience-item">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <strong>Experiencia ${index + 1}</strong>
                    <button type="button" class="btn btn-outline-danger btn-sm remove-experience">
                        Eliminar
                    </button>
                </div>

                <!-- FILA 1 -->
                <div class="mb-3">
                    <input type="text"
                           name="experiences[${index}][empresa]"
                           class="form-control"
                           placeholder="Empresa">
                </div>

                <!-- FILA 2 -->
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <select name="experiences[${index}][pais_id]" class="form-select">
                            <option value="">País</option>
                            @foreach ($paises as $pais)
                                <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <input type="text"
                               name="experiences[${index}][cargo]"
                               class="form-control"
                               placeholder="Cargo">
                    </div>
                </div>

                <!-- FILA 3 -->
                <div>
                    <textarea name="experiences[${index}][descripcion]"
                              class="form-control"
                              rows="3"
                              placeholder="Descripción de funciones"></textarea>
                </div>

            </div>
        `;

            wrapperExp.insertAdjacentHTML('beforeend', template);
        });

        wrapperExp.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-experience')) {
                e.target.closest('.experience-item').remove();
            }
        });

    });
</script>

@section('cuenta-content')
    <h2 class="mb-4 text-primary">Mi Perfil</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('perfil.store') }}">
        @csrf

        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link active" data-bs-toggle="tab" data-bs-target="#personal"
                            role="tab">
                            Información Personal
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#academica"
                            role="tab">
                            Formación Académica
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#idiomas"
                            role="tab">
                            Idiomas
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#experiencia"
                            role="tab">
                            Experiencia Laboral
                        </button>
                    </li>
                </ul>
            </div>

            <div class="card-body tab-content">

                <div class="tab-pane fade show active" id="personal">
                    @include('perfil.partials.personal')
                </div>

                <div class="tab-pane fade" id="academica">
                    @include('perfil.partials.academica')
                </div>

                <div class="tab-pane fade" id="idiomas">
                    @include('perfil.partials.idiomas')
                </div>

                <div class="tab-pane fade" id="experiencia">
                    @include('perfil.partials.experiencia')
                </div>

            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success">
                    💾 Guardar perfil
                </button>
            </div>
        </div>
    </form>
@endsection

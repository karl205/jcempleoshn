@extends('layouts.cuenta')

@section('cuenta-content')
    <h2 class="mb-4 text-primary">Mi Perfil</h2>

    <div class="text-end mb-3">
        <button class="btn btn-outline-success btn-sm">
            <i class="bi bi-file-earmark-arrow-down"></i> Generar currículum
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#personal">
                        Información Personal
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#academica">
                        Formación Académica
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#idiomas">
                        Idiomas
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#experiencia">
                        Experiencia laboral
                    </button>
                </li>
            </ul>
        </div>

        <div class="card-body tab-content">

            {{-- PERSONAL --}}
            <div class="tab-pane fade show active" id="personal">
                @include('perfil.partials.personal')
            </div>

            {{-- ACADÉMICA --}}
            <div class="tab-pane fade" id="academica">
                @include('perfil.partials.academica')
            </div>

            {{-- IDIOMAS --}}
            <div class="tab-pane fade" id="idiomas">
                @include('perfil.partials.idiomas')
            </div>

            {{-- EXPERIENCIA --}}
            <div class="tab-pane fade" id="experiencia">
                @include('perfil.partials.experiencia')
            </div>

        </div>
    </div>
@endsection

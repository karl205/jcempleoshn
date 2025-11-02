@extends('layouts.admin')

@section('content')
<h2 class="mb-4 text-primary">Catálogos del Sistemas</h2>

<div class="row g-4">
    <!-- Catálogo: Países -->
    <div class="col-md-6">
        @include('admin.catalogos._catalogo', [
            'titulo' => 'Países',
            'items' => ['Honduras', 'Guatemala'],
            'placeholder' => 'Nuevo país...'
        ])
    </div>

    <!-- Catálogo: Nivel de Estudio -->
    <div class="col-md-6">
        @include('admin.catalogos._catalogo', [
            'titulo' => 'Niveles de Estudio',
            'items' => ['Bachillerato', 'Universitario'],
            'placeholder' => 'Nuevo nivel...'
        ])
    </div>

    <!-- Catálogo: Actividad Laboral -->
    <div class="col-md-6">
        @include('admin.catalogos._catalogo', [
            'titulo' => 'Actividades Laborales',
            'items' => ['Ventas', 'Contabilidad'],
            'placeholder' => 'Nueva actividad...'
        ])
    </div>

    <!-- Catálogo: Categoría Laboral -->
    <div class="col-md-6">
        @include('admin.catalogos._catalogo', [
            'titulo' => 'Categorías Laborales',
            'items' => ['Administración', 'Tecnología'],
            'placeholder' => 'Nueva categoría...'
        ])
    </div>

    <!-- Catálogo: Cargos (dependen de Categoría) -->
    <div class="col-md-6">
        @include('admin.catalogos._catalogo', [
            'titulo' => 'Cargos (por categoría)',
            'catalogo' => 'cargos', {{-- bandera para que en _catalogo.blade.php muestre el select vacío --}}
            'items' => [
                'Programador Web', 'Asistente', 'Diseñador UX', 'Técnico de Soporte', 
                'Administrador de Redes', 'Tester QA', 'Líder Técnico', 'Consultor SAP',
                'Desarrollador Frontend', 'Backend Developer', 'Scrum Master',
                'Data Analyst', 'Product Owner', 'Arquitecto de Software', 'DevOps Engineer',
                'Analista de Seguridad', 'Project Manager', 'IT Manager'
            ],
            'placeholder' => 'Nuevo cargo...',
            'scroll' => true
        ])
    </div>

    <!-- Catálogo: Idiomas -->
    <div class="col-md-6">
        @include('admin.catalogos._catalogo', [
            'titulo' => 'Idiomas',
            'items' => ['Español', 'Inglés'],
            'placeholder' => 'Nuevo idioma...'
        ])
    </div>

    <!-- Catálogo: Áreas de Estudio -->
    <div class="col-md-6">
        @include('admin.catalogos._catalogo', [
            'titulo' => 'Áreas de Estudio',
            'items' => ['Ingeniería', 'Ciencias Sociales'],
            'placeholder' => 'Nueva área...'
        ])
    </div>

    <!-- Catálogo: Departamentos -->
    <div class="col-md-6">
        @include('admin.catalogos._catalogo', [
            'titulo' => 'Departamentos',
            'items' => ['Francisco Morazán', 'Cortés'],
            'placeholder' => 'Nuevo departamento...'
        ])
    </div>

    <!-- Catálogo: Ciudades (dependen de Departamento) -->
    <div class="col-md-6">
        @include('admin.catalogos._catalogo', [
            'titulo' => 'Ciudades (por departamento)',
            'items' => ['Tegucigalpa', 'San Pedro Sula'],
            'placeholder' => 'Nueva ciudad...'
        ])
    </div>
</div>
@endsection


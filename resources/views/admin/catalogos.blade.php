@extends('layouts.admin')

@section('content')

<h2 class="mb-4 text-primary">Categorías Laborales</h2>

<div class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-muted">
        Catálogo de categorías laborales del sistema
    </span>

    <button class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalCrearCategoria">
        <i class="bi bi-plus-circle me-1"></i> Nueva Categoría
    </button>
</div>

@include('admin.catalogos._catalogo')

@endsection



@extends('layouts.cuenta')

@section('cuenta-content')

<h2 class="mb-4 text-dark fw-semibold">Configuración de cuenta</h2>

{{-- Información de perfil --}}
<div class="settings-card">
    <div class="settings-title">Información de perfil</div>
    <div class="settings-hint">Actualiza tu nombre y correo electrónico</div>

    <form method="POST" action="#">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" placeholder="Tu nombre actual">
        </div>

        <div class="mb-3">
            <label class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" placeholder="tu@correo.com">
        </div>

        <div class="settings-actions">
            <button type="submit" class="btn-primary-soft">
                <i class="bi bi-save me-1"></i> Guardar cambios
            </button>
            <button type="button" class="btn-secondary-soft">Cancelar</button>
        </div>
    </form>
</div>

{{-- Seguridad --}}
<div class="settings-card">
    <div class="settings-title">Seguridad</div>
    <div class="settings-hint">Cambia tu contraseña</div>

    <form method="POST" action="#">
        @csrf

        <div class="mb-3">
            <label class="form-label">Contraseña actual</label>
            <input type="password" class="form-control" placeholder="••••••••">
        </div>

        <div class="mb-3">
            <label class="form-label">Nueva contraseña</label>
            <input type="password" class="form-control" placeholder="••••••••">
        </div>

        <div class="mb-3">
            <label class="form-label">Confirmar nueva contraseña</label>
            <input type="password" class="form-control" placeholder="••••••••">
        </div>

        <div class="settings-actions">
            <button type="submit" class="btn-primary-soft">
                <i class="bi bi-shield-lock me-1"></i> Actualizar contraseña
            </button>
            <button type="button" class="btn-secondary-soft">Cancelar</button>
        </div>
    </form>
</div>

{{-- Eliminar cuenta --}}
<div class="settings-card danger-zone">
    <div class="danger-title">Eliminar cuenta</div>
    <div class="danger-text">
        Esta acción es permanente. Toda tu información será eliminada y no podrá recuperarse.
    </div>

    <form method="POST" action="#">
        @csrf
        <button type="submit" class="btn-danger-soft">
            <i class="bi bi-trash me-1"></i> Borrar cuenta
        </button>
    </form>
</div>

@endsection

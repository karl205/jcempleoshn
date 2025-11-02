@extends('layouts.cuenta')

@section('cuenta-content')
<style>
  .section-box {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
  }
  .section-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: .5rem;
    color: #111827;
  }
  .section-hint {
    font-size: .9rem;
    color: #6b7280;
    margin-bottom: 1.5rem;
  }
  .btn-matte {
    background: #1f2937;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: .6rem 1.2rem;
    font-weight: 500;
    transition: all .15s ease;
  }
  .btn-matte:hover {
    background: #111827;
  }
  .btn-light {
    background: #f9fafb;
    color: #111827;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    padding: .6rem 1.2rem;
    font-weight: 500;
    transition: all .15s ease;
  }
  .btn-light:hover {
    background: #f3f4f6;
  }
  .danger-zone {
    border: 1px solid #fca5a5;
    background: #fff;
  }
  .danger-title {
    color: #b91c1c;
    font-weight: 600;
    margin-bottom: .25rem;
  }
  .danger-text {
    color: #7f1d1d;
    font-size: .9rem;
  }
</style>

<h2 class="mb-4 text-dark">Configuración de cuenta</h2>

{{-- Sección: Nombre y correo --}}
<div class="section-box">
  <div class="section-title">Información de perfil</div>
  <div class="section-hint">Actualiza tu nombre y correo electrónico</div>

  <form method="POST" action="#">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="name" placeholder="Tu nombre actual">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Correo electrónico</label>
      <input type="email" class="form-control" id="email" placeholder="tu@correo.com">
    </div>

    <div class="d-flex gap-2">
      <button type="submit" class="btn-matte">Guardar cambios</button>
      <button type="button" class="btn-light">Cancelar</button>
    </div>
  </form>
</div>

{{-- Sección: Contraseña --}}
<div class="section-box">
  <div class="section-title">Seguridad</div>
  <div class="section-hint">Cambia tu contraseña</div>

  <form method="POST" action="#">
    @csrf
    <div class="mb-3">
      <label for="current_password" class="form-label">Contraseña actual</label>
      <input type="password" class="form-control" id="current_password" placeholder="••••••••">
    </div>
    <div class="mb-3">
      <label for="new_password" class="form-label">Nueva contraseña</label>
      <input type="password" class="form-control" id="new_password" placeholder="••••••••">
    </div>
    <div class="mb-3">
      <label for="new_password_confirmation" class="form-label">Confirmar nueva contraseña</label>
      <input type="password" class="form-control" id="new_password_confirmation" placeholder="••••••••">
    </div>

    <div class="d-flex gap-2">
      <button type="submit" class="btn-matte">Actualizar contraseña</button>
      <button type="button" class="btn-light">Cancelar</button>
    </div>
  </form>
</div>

{{-- Sección: Borrar cuenta --}}
<div class="section-box danger-zone">
  <div class="danger-title">Elimina tu cuenta</div>
  <div class="danger-text mb-3">Al borrar tu cuenta, toda tu información será eliminada de forma permanente. No habrá forma de recuperarla.</div>

  <form method="POST" action="#">
    @csrf
    <button type="submit" class="btn-danger-matte">Borrar cuenta</button>
</form>

<style>
  .btn-danger-matte {
    background: #dc2626;   /* rojo intenso */
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: .6rem 1.2rem;
    font-weight: 500;
    transition: all .15s ease;
  }
  .btn-danger-matte:hover {
    background: #b91c1c;   /* rojo más oscuro al pasar */
  }
</style>

</div>
@endsection










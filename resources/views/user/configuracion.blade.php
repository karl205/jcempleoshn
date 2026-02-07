@extends('layouts.cuenta')

@section('cuenta-content')

    {{-- Toast flotante de éxito --}}
    @if (session('success'))
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index:1080;">
            <div id="successToast" class="toast align-items-center text-bg-success border-0 show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>

        <script>
            setTimeout(() => {
                const toast = document.getElementById('successToast');
                if (toast) toast.classList.remove('show');
            }, 3500);
        </script>
    @endif

    {{-- Errores --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2 class="mb-4 text-dark fw-semibold">Configuración de cuenta</h2>

    {{-- ===================== Información de perfil ===================== --}}
    <div class="settings-card">
        <div class="settings-title">Información de perfil</div>
        <div class="settings-hint">Actualiza tu información personal</div>

        <form method="POST" action="{{ route('cuenta.configuracion.perfil') }}">
            @csrf
            @method('PUT')

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre"
                        value="{{ old('nombre', auth()->user()->nombre) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Apellido</label>
                    <input type="text" class="form-control" name="apellido"
                        value="{{ old('apellido', auth()->user()->apellido) }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" value="{{ auth()->user()->email }}" readonly
                    style="background-color:#f9fafb; cursor:not-allowed;">
            </div>

            <div class="settings-actions">
                <button type="submit" class="btn-primary-soft">
                    <i class="bi bi-save me-1"></i> Guardar cambios
                </button>
                <button type="button" class="btn-secondary-soft">Cancelar</button>
            </div>
        </form>
    </div>

    {{-- ===================== Seguridad ===================== --}}
    <div class="settings-card">
        <div class="settings-title">Seguridad</div>
        <div class="settings-hint">Cambia tu contraseña</div>

        <form method="POST" action="{{ route('cuenta.configuracion.password') }}">
            @csrf
            @method('PUT')

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label">Contraseña actual</label>
                    <input type="password" name="current_password" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Nueva contraseña</label>
                    <input type="password" id="password" name="password" class="form-control">
                    <div class="form-text text-muted" id="passwordHelp">
                        Mínimo 8 caracteres
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Confirmar nueva contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                    <div class="form-text" id="passwordMatch"></div>
                </div>
            </div>

            <div class="settings-actions">
                <button type="submit" class="btn-primary-soft">
                    <i class="bi bi-shield-lock me-1"></i> Actualizar contraseña
                </button>
                <button type="button" class="btn-secondary-soft">Cancelar</button>
            </div>
        </form>
    </div>

    {{-- ===================== Eliminar cuenta ===================== --}}
    <div class="settings-card danger-zone">
        <div class="danger-title">Eliminar cuenta</div>
        <div class="danger-text">
            Esta acción es permanente. Toda tu información será eliminada y no podrá recuperarse.
        </div>

        <form method="POST" action="{{ route('cuenta.configuracion.destroy') }}"
            onsubmit="return confirm('¿Seguro que deseas eliminar tu cuenta?');">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn-danger-soft">
                <i class="bi bi-trash me-1"></i> Borrar cuenta
            </button>
        </form>
    </div>

    {{-- ===================== JS validación en vivo ===================== --}}
    <script>
        const password = document.getElementById('password');
        const confirm = document.getElementById('password_confirmation');
        const help = document.getElementById('passwordHelp');
        const match = document.getElementById('passwordMatch');

        function validatePassword() {
            if (!password.value) {
                help.textContent = 'Mínimo 8 caracteres';
                help.className = 'form-text text-muted';
                return;
            }

            if (password.value.length < 8) {
                help.textContent = 'La contraseña es muy corta';
                help.className = 'form-text text-danger';
            } else {
                help.textContent = 'Contraseña válida';
                help.className = 'form-text text-success';
            }
        }

        function validateMatch() {
            if (!confirm.value) {
                match.textContent = '';
                return;
            }

            if (password.value === confirm.value) {
                match.textContent = 'Las contraseñas coinciden';
                match.className = 'form-text text-success';
            } else {
                match.textContent = 'Las contraseñas no coinciden';
                match.className = 'form-text text-danger';
            }
        }

        if (password && confirm) {
            password.addEventListener('input', () => {
                validatePassword();
                validateMatch();
            });

            confirm.addEventListener('input', validateMatch);
        }
    </script>

@endsection

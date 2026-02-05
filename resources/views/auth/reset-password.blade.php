@extends('layouts.app')

@section('content')
    <div class="row w-100 justify-content-center">

        <div class="col-11 col-sm-8 col-md-6 col-lg-5">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4 p-md-5">

                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/logoEmpresa.jpg') }}" alt="JC Empleos"
                            class="rounded-circle shadow-sm" style="width:90px; height:90px">
                    </div>

                    <h4 class="text-center fw-bold mb-3">
                        Restablecer contrasena
                    </h4>

                    <p class="text-center text-muted small mb-4">
                        Ingresa tu nueva contrasena para continuar.
                    </p>

                    @if ($errors->any())
                        <div class="alert alert-danger small">
                            Revisa los datos e intentalo nuevamente.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ old('email', request()->email) }}">

                        <!-- Nueva contrasena -->
                        <div class="mb-3">
                            <label class="form-label">Nueva contrasena</label>
                            <input id="password" type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required>

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Requisitos -->
                        <ul class="list-unstyled small mb-3" id="password-requisitos">
                            <li id="mayuscula" class="text-danger">❌ Al menos una letra mayuscula</li>
                            <li id="numero" class="text-danger">❌ Al menos un numero</li>
                            <li id="longitud" class="text-danger">❌ Mas de 10 caracteres</li>
                        </ul>

                        <!-- Confirmacion -->
                        <div class="mb-3">
                            <label class="form-label">Confirmar contrasena</label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                class="form-control" required>

                            <div id="coincidencia" class="small mt-1 d-none"></div>
                        </div>

                        <!-- Boton -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg rounded-pill">
                                Guardar nueva contrasena
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

    {{-- Script validacion contrasena (SIN cambios de logica) --}}
    <script>
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('password_confirmation');
        const mayuscula = document.getElementById('mayuscula');
        const numero = document.getElementById('numero');
        const longitud = document.getElementById('longitud');
        const coincidencia = document.getElementById('coincidencia');

        function validarPassword() {
            const v = passwordInput.value;
            update(mayuscula, /[A-Z]/.test(v), 'Al menos una letra mayuscula');
            update(numero, /\d/.test(v), 'Al menos un numero');
            update(longitud, v.length > 10, 'Mas de 10 caracteres');
        }

        function update(el, ok, txt) {
            el.className = ok ? 'text-success' : 'text-danger';
            el.textContent = (ok ? '✅ ' : '❌ ') + txt;
        }

        function validarCoincidencia() {
            if (passwordInput.value && confirmInput.value) {
                const ok = passwordInput.value === confirmInput.value;
                coincidencia.classList.remove('d-none');
                coincidencia.className = ok ?
                    'text-success small mt-1' :
                    'text-danger small mt-1';

                coincidencia.textContent = ok ?
                    '✅ Las contrasenas coinciden' :
                    '❌ Las contrasenas no coinciden';
            } else {
                coincidencia.classList.add('d-none');
            }
        }

        passwordInput.addEventListener('input', () => {
            validarPassword();
            validarCoincidencia();
        });

        confirmInput.addEventListener('input', validarCoincidencia);
    </script>
@endsection

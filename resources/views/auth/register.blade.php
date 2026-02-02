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

                    <h4 class="text-center fw-bold mb-4">
                        Registro de Usuario
                    </h4>

                    @if ($errors->any())
                        <div class="alert alert-danger small">
                            Revisa los campos e inténtalo de nuevo.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label class="form-label">Nombre completo</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>

                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror" placeholder="ejemplo@correo.com"
                                required autocomplete="email">

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <!-- Password -->
                        <div class="mb-3 position-relative">
                            <label class="form-label">Contraseña</label>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required>

                            <div id="password-tooltip"
                                class="position-absolute bg-white border rounded shadow p-2 small mt-2 w-100 d-none"
                                style="z-index:10;">
                                <ul class="mb-0 ps-3">
                                    <li id="mayuscula" class="text-danger">❌ Al menos una letra mayúscula</li>
                                    <li id="numero" class="text-danger">❌ Al menos un número</li>
                                    <li id="longitud" class="text-danger">❌ Más de 10 caracteres</li>
                                </ul>
                            </div>

                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirmar -->
                        <div class="mb-3">
                            <label class="form-label">Confirmar contraseña</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" required>
                            <div id="coincidencia" class="small mt-1 d-none"></div>
                        </div>

                        <!-- Botón -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-success btn-lg rounded-pill">
                                Registrarse
                            </button>
                        </div>

                        <div class="text-center">
                            <span class="small">¿Ya tienes una cuenta?</span>
                            <a href="{{ route('login') }}" class="small fw-bold text-decoration-none">
                                Inicia sesión
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

    {{-- Script validación contraseña (SIN CAMBIOS) --}}
    <script>
        const p = document.getElementById('password');
        const c = document.getElementById('password_confirmation');
        const t = document.getElementById('password-tooltip');

        const req = {
            mayuscula: document.getElementById('mayuscula'),
            numero: document.getElementById('numero'),
            longitud: document.getElementById('longitud')
        };

        const coinc = document.getElementById('coincidencia');

        p.addEventListener('focus', () => t.classList.remove('d-none'));
        p.addEventListener('blur', () => t.classList.add('d-none'));

        p.addEventListener('input', () => {
            const v = p.value;
            update(req.mayuscula, /[A-Z]/.test(v), 'Al menos una letra mayúscula');
            update(req.numero, /[0-9]/.test(v), 'Al menos un número');
            update(req.longitud, v.length > 10, 'Más de 10 caracteres');
        });

        function update(el, ok, txt) {
            el.className = ok ? 'text-success' : 'text-danger';
            el.textContent = (ok ? '✅ ' : '❌ ') + txt;
        }

        function checkMatch() {
            if (p.value && c.value) {
                const ok = p.value === c.value;
                coinc.classList.remove('d-none');
                coinc.className = ok ? 'text-success small' : 'text-danger small';
                coinc.textContent = ok ?
                    '✅ Las contraseñas coinciden' :
                    '❌ Las contraseñas no coinciden';
            } else {
                coinc.classList.add('d-none');
            }
        }

        p.addEventListener('input', checkMatch);
        c.addEventListener('input', checkMatch);
    </script>
@endsection

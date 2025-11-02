@php
    use Illuminate\Http\Request;
@endphp

@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('{{ asset('assets/images/imagenInicioSesion.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
</style>

<!-- Logo en la parte inferior derecha -->
<img src="{{ asset('assets/images/logoEmpresa.jpg') }}" alt="Logo Empresa" class="logo-empresa">

<!-- Estilos para el logo -->
<style>
    /* Logo en la parte inferior derecha */
    .logo-empresa {
        position: fixed;
        bottom: 18px; /* Ajusta el margen inferior según necesites */
        right: 18px; /* Ajusta el margen derecho según necesites */
        width: 180px; /* Aumenta el tamaño del logo, ajustando el ancho */
        height: auto; /* Mantiene la proporción de la imagen */
        z-index: 1000; /* Asegura que el logo esté encima del contenido */
    }
</style>


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header bg-dark text-white text-center">
                    <h4>Restablecer Contraseña</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

    <form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ old('email', request()->input('email')) }}">


    <div class="mb-3">
        <label for="password" class="form-label">Nueva Contraseña</label>
        <input id="password" type="password" class="form-control" name="password" required>
    </div>

    <ul class="list-unstyled mb-3" id="password-requisitos">
        <li id="mayuscula" class="text-danger">❌ Al menos una letra mayúscula</li>
        <li id="numero" class="text-danger">❌ Al menos un número</li>
        <li id="longitud" class="text-danger">❌ Más de 10 caracteres</li>
    </ul>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
    </div>

    <div class="mb-3">
        <span id="coincidencia" class="text-danger">❌ Las contraseñas no coinciden</span>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-success">Guardar nueva contraseña</button>
    </div>
</form>

                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const mayuscula = document.getElementById('mayuscula');
    const numero = document.getElementById('numero');
    const longitud = document.getElementById('longitud');
    const coincidencia = document.getElementById('coincidencia');

    function validarPassword() {
        const valor = passwordInput.value;

        // Validar mayúscula
        if (/[A-Z]/.test(valor)) {
            mayuscula.classList.remove('text-danger');
            mayuscula.classList.add('text-success');
            mayuscula.textContent = '✅ Al menos una letra mayúscula';
        } else {
            mayuscula.classList.add('text-danger');
            mayuscula.classList.remove('text-success');
            mayuscula.textContent = '❌ Al menos una letra mayúscula';
        }

        // Validar número
        if (/\d/.test(valor)) {
            numero.classList.remove('text-danger');
            numero.classList.add('text-success');
            numero.textContent = '✅ Al menos un número';
        } else {
            numero.classList.add('text-danger');
            numero.classList.remove('text-success');
            numero.textContent = '❌ Al menos un número';
        }

        // Validar longitud
        if (valor.length >= 10) {
            longitud.classList.remove('text-danger');
            longitud.classList.add('text-success');
            longitud.textContent = '✅ Más de 10 caracteres';
        } else {
            longitud.classList.add('text-danger');
            longitud.classList.remove('text-success');
            longitud.textContent = '❌ Más de 10 caracteres';
        }
    }

    function validarCoincidencia() {
        if (passwordInput.value === confirmInput.value && confirmInput.value !== '') {
            coincidencia.classList.remove('text-danger');
            coincidencia.classList.add('text-success');
            coincidencia.textContent = '✅ Las contraseñas coinciden';
        } else {
            coincidencia.classList.add('text-danger');
            coincidencia.classList.remove('text-success');
            coincidencia.textContent = '❌ Las contraseñas no coinciden';
        }
    }

    passwordInput.addEventListener('input', () => {
        validarPassword();
        validarCoincidencia();
    });

    confirmInput.addEventListener('input', validarCoincidencia);
</script>

@endsection


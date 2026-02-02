@extends('layouts.app')

@section('content')
    <div class="row w-100 justify-content-center">

        <div class="col-11 col-sm-8 col-md-5 col-lg-4">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4 p-md-5">

                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/logoEmpresa.jpg') }}" alt="JC Empleos"
                            class="rounded-circle shadow-sm" style="width:90px; height:90px">
                    </div>

                    <!-- Título -->
                    <h4 class="text-center fw-bold mb-3">
                        Recuperar Contraseña
                    </h4>

                    <p class="text-center text-muted small mb-4">
                        Ingresa tu correo electrónico y te enviaremos un enlace
                        para restablecer tu contraseña.
                    </p>

                    <!-- Estado -->
                    @if (session('status'))
                        <div class="alert alert-success small text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger small">
                            Revisa el correo ingresado e inténtalo nuevamente.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Ingresa tu correo"
                                required autofocus>

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Botón -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-success btn-lg rounded-pill">
                                Enviar enlace de recuperación
                            </button>
                        </div>

                        <!-- Volver -->
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="small text-decoration-none">
                                Volver al inicio de sesión
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

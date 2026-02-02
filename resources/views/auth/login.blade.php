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

                    <h4 class="text-center fw-bold mb-4">Iniciar Sesión</h4>

                    @if (session('warning'))
                        <div class="alert alert-warning small text-center">
                            {{ session('warning') }}
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success small text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger small">
                            Ups, revisa los campos e inténtalo de nuevo.
                        </div>
                    @endif


                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                Recordarme
                            </label>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                                Iniciar sesión
                            </button>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-center mb-2">
                                <a href="{{ route('password.request') }}" class="small text-decoration-none">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                        @endif

                        <div class="text-center">
                            <span class="small">¿No tienes cuenta?</span>
                            <a href="{{ route('register') }}" class="small fw-bold text-decoration-none">
                                Regístrate aquí
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

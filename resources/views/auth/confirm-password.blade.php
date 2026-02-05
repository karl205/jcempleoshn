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

                    <h4 class="text-center fw-bold mb-3">
                        Confirmar contrasena
                    </h4>

                    <p class="text-center small text-muted mb-4">
                        Esta es un area segura de la aplicacion.
                        Por favor confirma tu contrasena para continuar.
                    </p>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <!-- Contrasena -->
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Contrasena
                            </label>

                            <input id="password" type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required
                                autocomplete="current-password">

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Boton -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                                Confirmar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="row w-100 justify-content-center">

        <div class="col-11 col-sm-9 col-md-7 col-lg-6">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4 p-md-5 text-center">

                    <!-- Logo -->
                    <div class="mb-4">
                        <img src="{{ asset('assets/images/logoEmpresa.jpg') }}" alt="JC Empleos"
                            class="rounded-circle shadow-sm" style="width:90px; height:90px">
                    </div>

                    <h4 class="fw-bold mb-3">
                        Verifica tu correo electrónico
                    </h4>

                    <p class="text-muted mb-4">
                        Gracias por registrarte. Antes de comenzar, necesitamos que verifiques
                        tu dirección de correo electrónico haciendo clic en el enlace que te enviamos.
                        <br><br>
                        Si no recibiste el correo, puedes solicitar que te enviemos uno nuevo.
                    </p>

                    {{-- Mensaje cuando se reenvía el correo --}}
                    @if (session('message'))
                        <div class="alert alert-success small">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="d-flex flex-column flex-md-row justify-content-center gap-3 mt-4">

                        <!-- Reenviar -->
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4">
                                Reenviar correo de verificación
                            </button>
                        </form>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                                Cerrar sesión
                            </button>
                        </form>

                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

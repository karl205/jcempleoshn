<x-guest-layout>
    <!-- Logo arriba -->
    <div class="mb-4 text-center">
        <img src="{{ asset('assets/images/logoEmpresa.jpg') }}"
             alt="Logo Empresa"
             style="width:90px; height:90px"
             class="mx-auto rounded-lg border-2 border-gray-300 shadow-md">
    </div>

    <!-- Título -->
    <h2 class="text-center text-2xl font-bold text-gray-700 mb-6">
        Recuperar Contraseña
    </h2>

    <!-- Estado de sesión (Breeze) -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Correo -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email"
                          class="block mt-1 w-full"
                          type="email"
                          name="email"
                          :value="old('email')"
                          required
                          autofocus
                          placeholder="Ingresa tu correo para recibir el enlace" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Botón principal (verde, ancho completo) -->
        <div class="mt-2">
            <x-primary-button
                class="w-full justify-center !bg-emerald-600 hover:!bg-emerald-700
                       !text-white !font-semibold px-5 py-2 rounded-md
                       focus:!ring-2 focus:!ring-emerald-500 focus:!ring-offset-2">
                {{ __('Enviar enlace de recuperación') }}
            </x-primary-button>
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}"
               class="underline text-sm text-gray-600 hover:text-gray-900">
                Volver al inicio de sesión
            </a>
        </div>
    </form>
</x-guest-layout>



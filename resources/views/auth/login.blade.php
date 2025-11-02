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
        Iniciar Sesión
    </h2>

    <!-- Estado de sesión (Breeze) -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Errores -->
    @if ($errors->any())
        <div class="mb-4 font-medium text-red-600">
            {{ __('Ups, revisa los campos e inténtalo de nuevo.') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Correo -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full"
                          type="email"
                          name="email"
                          :value="old('email')"
                          required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Contraseña -->
        <div>
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Recordarme -->
        <div class="block">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                       name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                   href="{{ route('password.request') }}">
                    {{ __('¿Olvidaste tu contraseña?') }}
                </a>
            @endif

            <x-primary-button>
                {{ __('Iniciar sesión') }}
            </x-primary-button>
        </div>

        <div class="text-center mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                {{ __('¿No tienes una cuenta? Regístrate aquí') }}
            </a>
        </div>
    </form>


    
</x-guest-layout>















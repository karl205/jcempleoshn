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
        Registro de Usuario
    </h2>

    @if ($errors->any())
        <div class="mb-4 font-medium text-red-600">
            {{ __('Revisa los campos e inténtalo de nuevo.') }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nombre completo')" />
            <x-text-input id="name" name="name" type="text" class="block mt-1 w-full"
                          :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email" name="email" type="email" class="block mt-1 w-full"
                          :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password con tooltip flotante -->
        <div class="relative">
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" name="password" type="password" class="block mt-1 w-full" required />

            <div id="password-tooltip"
                 class="absolute bg-white border rounded shadow p-2 text-sm mt-2 w-full hidden z-10">
                <ul class="m-0 ps-3">
                    <li id="mayuscula" class="text-red-600">❌ Al menos una letra mayúscula</li>
                    <li id="numero"   class="text-red-600">❌ Al menos un número</li>
                    <li id="longitud" class="text-red-600">❌ Más de 10 caracteres</li>
                </ul>
            </div>
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                          class="block mt-1 w-full" required />
            <div id="coincidencia" class="mt-1 text-red-600 hidden">❌ Las contraseñas no coinciden</div>
        </div>

        <!-- Botón verde ancho completo como en login -->
        <div class="mt-2">
            <x-primary-button
                class="w-full justify-center !bg-emerald-600 hover:!bg-emerald-700
                       !text-white !font-semibold px-5 py-2 rounded-md
                       focus:!ring-2 focus:!ring-emerald-500 focus:!ring-offset-2">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                ¿Ya tienes una cuenta? Inicia sesión
            </a>
        </div>
    </form>

    {{-- Script tooltip --}}
    <script>
        const $p = document.getElementById('password');
        const $c = document.getElementById('password_confirmation');
        const $t = document.getElementById('password-tooltip');
        const req = {
            mayuscula: document.getElementById('mayuscula'),
            numero: document.getElementById('numero'),
            longitud: document.getElementById('longitud')
        };
        const coinc = document.getElementById('coincidencia');

        $p.addEventListener('focus', () => $t.classList.remove('hidden'));
        $p.addEventListener('blur',  () => $t.classList.add('hidden'));

        $p.addEventListener('input', () => {
            const v = $p.value;
            const okM = /[A-Z]/.test(v), okN = /[0-9]/.test(v), okL = v.length > 10;
            req.mayuscula.className = okM ? 'text-green-600' : 'text-red-600';
            req.numero.className    = okN ? 'text-green-600' : 'text-red-600';
            req.longitud.className  = okL ? 'text-green-600' : 'text-red-600';
            req.mayuscula.textContent = (okM ? '✅' : '❌') + ' Al menos una letra mayúscula';
            req.numero.textContent    = (okN ? '✅' : '❌') + ' Al menos un número';
            req.longitud.textContent  = (okL ? '✅' : '❌') + ' Más de 10 caracteres';
        });

        function checkMatch() {
            if ($p.value && $c.value) {
                const ok = $p.value === $c.value;
                coinc.classList.remove('hidden');
                coinc.className = (ok ? 'text-green-600' : 'text-red-600') + ' mt-1';
                coinc.textContent = ok ? '✅ Las contraseñas coinciden' : '❌ Las contraseñas no coinciden';
            } else {
                coinc.classList.add('hidden');
            }
        }
        $p.addEventListener('input', checkMatch);
        $c.addEventListener('input', checkMatch);
    </script>
</x-guest-layout>





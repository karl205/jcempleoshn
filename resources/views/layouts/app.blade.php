<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>JC Empleos Honduras</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Global CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    @stack('styles')
</head>

<body class="bg-light">

    {{-- NAVBAR --}}
    @include('layouts.nav')

    {{-- CONTENIDO --}}
    <main class="container-fluid py-4">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('layouts.footer')

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')
</body>

</html>

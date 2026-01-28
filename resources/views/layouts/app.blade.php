@stack('styles')

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>JC Empleos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-hover:hover {
            background-color: #dee2e6;
            /* gris claro */
            transition: background-color 0.3s ease, transform 0.2s ease;
            transform: translateY(-4px);
            /* efecto de "levantar" la tarjeta */
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <span style="font-size: 1.9rem;">J</span><span style="color: orange; font-size: 1.9rem;">C</span>
                Empleos Honduras
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.plazas') }}">
                            <i class="bi bi-briefcase-fill me-1"></i> Plazas
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.perfil') }}">
                            <i class="bi bi-person-circle me-1"></i> Mi perfil
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-box-arrow-right me-1"></i> Cerrar sesión
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="bi bi-pencil-square me-1"></i> Registro
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <!-- Contenido -->
    <main class="container mt-4">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

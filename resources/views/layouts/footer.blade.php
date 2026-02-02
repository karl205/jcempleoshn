<footer class="bg-dark text-white py-3">
    <div class="container">
        <div class="row justify-content-between gy-3">

            <div class="col-md-4">
                <h5 class="fw-bold">JC Empleos</h5>
                <p class="small mb-0">
                    Conectamos talento hondureño con oportunidades laborales reales.
                </p>
            </div>

            <div class="col-md-3">
                <h5 class="fw-bold">Navegación</h5>
                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="{{ url('/') }}" class="text-white text-decoration-none">
                            <i class="bi bi-house-door-fill me-1"></i> Inicio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.plazas') }}" class="text-white text-decoration-none">
                            <i class="bi bi-search me-1"></i> Buscar plazas
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-3">
                <h5 class="fw-bold">Contáctanos</h5>

                <p class="small mb-1">
                    <i class="bi bi-envelope-fill me-1"></i>
                    contacto@jcempleos.com
                </p>

                <p class="small mb-2">
                    <i class="bi bi-telephone-fill me-1"></i>
                    (504) 2222-3333
                </p>
            </div>

        </div>

        <hr class="border-secondary my-2">

        <div class="text-center small text-secondary">
            © {{ date('Y') }} JC Empleos. Todos los derechos reservados.
        </div>
    </div>
</footer>

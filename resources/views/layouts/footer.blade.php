<footer class="bg-dark text-white w-100 mt-5">
    <div class="container-fluid px-0">
        <div class="container py-4">
            <div class="row justify-content-between gx-5">
                <!-- Informacion -->
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">JC Empleos</h5>
                    <p class="small mb-0">
                        Conectamos talento hondureño con oportunidades laborales reales.
                        Plataforma confiable y eficaz para candidatos.
                    </p>
                </div>

                <!-- Navegacion -->
                <div class="col-md-3 mb-3">
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

                <!-- Contacto -->
                <div class="col-md-3 mb-3">
                    <h5 class="fw-bold">Contáctanos</h5>

                    <p class="small mb-1">
                        <i class="bi bi-envelope-fill me-1"></i>
                        <a href="mailto:contacto@jcempleos.com" class="text-white text-decoration-none">
                            contacto@jcempleos.com
                        </a>
                    </p>

                    <p class="small mb-2">
                        <i class="bi bi-telephone-fill me-1"></i>
                        <a href="tel:+50422223333" class="text-white text-decoration-none">
                            (504) 2222-3333
                        </a>
                    </p>

                    <div class="mt-2">
                        <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer"
                            class="text-white me-3 fs-5" aria-label="Facebook JC Empleos">
                            <i class="bi bi-facebook"></i>
                        </a>

                        <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer"
                            class="text-white fs-5" aria-label="Instagram JC Empleos">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>

            <hr class="border-secondary my-3">

            <div class="text-center small text-secondary">
                © {{ date('Y') }} JC Empleos. Todos los derechos reservados.
            </div>
        </div>
    </div>
</footer>

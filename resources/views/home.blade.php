@extends('layouts.app')

@section('content')
    <!-- Banner con imagen de fondo -->
    <div class="position-relative mb-5">
        <!-- Imagen grande a lo ancho -->
        <img src="{{ asset('assets/images/banner.jpg') }}" class="w-100" style="height: 450px; object-fit: cover;"
            alt="Banner">

        <!-- Filtro encima de la imagen -->
        <div class="position-absolute top-50 start-50 translate-middle bg-dark bg-opacity-75 text-white p-4 rounded shadow"
            style="width: 90%; max-width: 700px;">
            <h4 class="mb-3 text-center">Encuentra tu próxima oportunidad laboral</h4>
            <form action="{{ route('user.plazas') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <select class="form-select" name="area">
                        <option selected disabled>Área de trabajo</option>
                        <option>Administración</option>
                        <option>Informática</option>
                        <option>Ventas</option>
                        <option>Contabilidad</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select" name="cargo">
                        <option selected disabled>Cargo</option>
                        <option>Asistente</option>
                        <option>Gerente</option>
                        <option>Supervisor</option>
                        <option>Programador</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select" name="departamento">
                        <option selected disabled>Departamento (Honduras)</option>
                        <option>Francisco Morazán</option>
                        <option>Cortés</option>
                        <option>Olancho</option>
                        <option>Atlántida</option>
                    </select>
                </div>
                <div class="col-12 d-grid">
                    <button type="submit" class="btn btn-success btn-lg">🔍 Buscar ahora</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Últimas plazas -->
    <section class="mb-5">
        <h3 class="mb-4 text-primary fw-bold text-center">Últimas Plazas Publicadas</h3>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ([['titulo' => 'Asistente Administrativo', 'ubicacion' => 'Tegucigalpa, Honduras', 'fecha' => '1 día', 'actividad' => 'Financiero', 'categoria' => 'Administración'], ['titulo' => 'Técnico en Soporte', 'ubicacion' => 'Santa Ana, Honduras', 'fecha' => '2 días', 'actividad' => 'Soporte TI', 'categoria' => 'Tecnología'], ['titulo' => 'Diseñador Gráfico', 'ubicacion' => 'La Ceiba, Honduras', 'fecha' => '3 días', 'actividad' => 'Creativo', 'categoria' => 'Diseño'], ['titulo' => 'Contador General', 'ubicacion' => 'Tegucigalpa, Honduras', 'fecha' => '4 días', 'actividad' => 'Financiero', 'categoria' => 'Contabilidad'], ['titulo' => 'Programador Laravel', 'ubicacion' => 'San Pedro Sula, Honduras', 'fecha' => '5 días', 'actividad' => 'Desarrollo', 'categoria' => 'Tecnología'], ['titulo' => 'Recepcionista', 'ubicacion' => 'Comayagua, Honduras', 'fecha' => '6 días', 'actividad' => 'Atención al cliente', 'categoria' => 'Administración']] as $plaza)
                @php
                    // Extraer el número de días desde el texto 'X día(s)'
                    preg_match('/\d+/', $plaza['fecha'], $match);
                    $dias = isset($match[0]) ? (int) $match[0] : 999;
                @endphp

                <div class="col">
                    <div class="card h-100 border-0 shadow-sm card-hover position-relative">
                        {{-- Cartel NUEVO si tiene menos de 4 días --}}
                        @if ($dias <= 3)
                            <span class="badge bg-success position-absolute top-0 end-0 m-2">Nuevo</span>
                        @endif

                        <div class="card-body">
                            <h5 class="card-title mb-2 text-dark fs-small">
                                <i class="bi bi-briefcase-fill text-primary me-2"></i>{{ $plaza['titulo'] }}
                            </h5>

                            <p class="mb-1">
                                <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                                <strong>Ubicación:</strong> {{ $plaza['ubicacion'] }}
                            </p>

                            <p class="mb-1">
                                <i class="bi bi-diagram-3-fill text-info me-1"></i>
                                <strong>Actividad de trabajo:</strong> {{ $plaza['actividad'] }}
                            </p>

                            <p class="mb-2">
                                <i class="bi bi-tags-fill text-secondary me-1"></i>
                                <strong>Categoría laboral:</strong> {{ $plaza['categoria'] }}
                            </p>

                            <p class="mb-2">
                                <i class="bi bi-calendar-event-fill text-secondary me-1"></i>
                                <strong>Publicado:</strong> hace {{ $plaza['fecha'] }}
                            </p>

                            <a href="{{ route('user.plazas') }}" class="btn btn-sm btn-outline-primary">Ver más</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Sección: Visión · Misión · Objetivo -->
    <section class="mb-5">
        <style>
            .vm-card {
                background: #ffffff;
                border: 1px solid #e5e7eb;
                border-radius: 14px;
                box-shadow: 0 6px 18px rgba(0, 0, 0, .04);
                padding: 1.5rem;
                height: 100%;
                transition: transform .15s ease, box-shadow .15s ease;
            }

            .vm-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 24px rgba(0, 0, 0, .06);
            }

            .vm-title {
                display: flex;
                align-items: center;
                gap: .6rem;
                font-weight: 700;
                color: #111827;
                margin-bottom: .5rem;
            }

            .vm-pill {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 36px;
                height: 36px;
                border-radius: 50%;
                background: #f3f4f6;
                color: #111827;
                font-size: 18px;
                border: 1px solid #e5e7eb;
            }

            .vm-text {
                color: #4b5563;
                line-height: 1.6;
                margin: 0;
            }

            .vm-section-title {
                font-weight: 800;
                color: #111827;
                text-align: center;
                margin-bottom: .25rem;
            }

            .vm-section-sub {
                color: #6b7280;
                text-align: center;
                margin-bottom: 1.5rem;
            }

            @media (min-width:992px) {
                .vm-grid {
                    display: grid;
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                    gap: 1.25rem;
                }
            }

            @media (max-width:991.98px) {
                .vm-grid>* {
                    margin-bottom: 1rem;
                }
            }
        </style>

        <h3 class="vm-section-title">Visión · Misión · Objetivo</h3>
        <p class="vm-section-sub">Conoce el rumbo que guía nuestro trabajo y el impacto que buscamos lograr.</p>

        <div class="vm-grid">
            <!-- Visión -->
            <div>
                <div class="vm-card">
                    <div class="vm-title">
                        <span class="vm-pill"><i class="bi bi-eye"></i></span>
                        <span>Visión</span>
                    </div>
                    <p class="vm-text">
                        Ser la plataforma líder que conecta talento y oportunidades laborales en Centroamérica,
                        impulsando el crecimiento profesional con soluciones simples y efectivas.
                    </p>
                </div>
            </div>

            <!-- Misión -->
            <div>
                <div class="vm-card">
                    <div class="vm-title">
                        <span class="vm-pill"><i class="bi bi-flag"></i></span>
                        <span>Misión</span>
                    </div>
                    <p class="vm-text">
                        Facilitar el acceso a empleo de calidad mediante herramientas modernas, procesos transparentes
                        y una experiencia ágil tanto para candidatos como para empresas.
                    </p>
                </div>
            </div>

            <!-- Objetivo -->
            <div>
                <div class="vm-card">
                    <div class="vm-title">
                        <span class="vm-pill"><i class="bi bi-bullseye"></i></span>
                        <span>Objetivo</span>
                    </div>
                    <p class="vm-text">
                        Aumentar la tasa de colocación y la satisfacción de usuarios, optimizando búsqueda,
                        postulación y seguimiento con métricas claras y mejora continua.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Comentarios de clientes (carrusel paso a paso con bordes de color) -->
    <section class="mb-5">
        <style>
            .carousel-wrapper {
                overflow: hidden;
                position: relative;
                width: 100%;
                padding: 2rem 0;
                background: #ffffff;
                /* fondo blanco */
            }

            .carousel-track {
                display: flex;
                gap: 1.5rem;
                transition: transform 0.6s ease;
                padding: 0 1rem;
            }

            /* base de la burbuja */
            .testi-bubble {
                flex: 0 0 auto;
                width: 200px;
                height: 200px;
                border-radius: 50%;
                padding: 1rem 1rem 3rem 1rem;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                position: relative;
                background: #fff;
                /* fondo blanco */
                color: #111827;
            }

            .testi-text {
                font-size: .85rem;
                line-height: 1.3rem;
            }

            .testi-author {
                position: absolute;
                left: 50%;
                bottom: .6rem;
                transform: translateX(-50%);
                display: flex;
                align-items: center;
                gap: .5rem;
                background: #fff;
                border: 1px solid #e5e7eb;
                border-radius: .75rem;
                padding: .3rem .6rem;
                box-shadow: 0 3px 8px rgba(0, 0, 0, .05);
            }

            .testi-avatar {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-size: 16px;
            }

            .testi-name {
                font-size: .85rem;
                font-weight: 600;
            }

            .testi-role {
                font-size: .7rem;
                color: #374151;
            }

            /* solo bordes de color (pasteles) */
            .carousel-track .testi-bubble:nth-child(5n+1) {
                border: 3px solid #93c5fd;
                /* azul pastel */
            }

            .carousel-track .testi-bubble:nth-child(5n+1) .testi-avatar {
                background: #3b82f6;
            }

            .carousel-track .testi-bubble:nth-child(5n+2) {
                border: 3px solid #6ee7b7;
                /* verde pastel */
            }

            .carousel-track .testi-bubble:nth-child(5n+2) .testi-avatar {
                background: #10b981;
            }

            .carousel-track .testi-bubble:nth-child(5n+3) {
                border: 3px solid #fde68a;
                /* amarillo pastel */
            }

            .carousel-track .testi-bubble:nth-child(5n+3) .testi-avatar {
                background: #f59e0b;
            }

            .carousel-track .testi-bubble:nth-child(5n+4) {
                border: 3px solid #c4b5fd;
                /* morado lavanda */
            }

            .carousel-track .testi-bubble:nth-child(5n+4) .testi-avatar {
                background: #8b5cf6;
            }

            .carousel-track .testi-bubble:nth-child(5n+5) {
                border: 3px solid #fbcfe8;
                /* rosa pastel */
            }

            .carousel-track .testi-bubble:nth-child(5n+5) .testi-avatar {
                background: #ec4899;
            }

            .btn-matte {
                background: #374151;
                color: #fff;
                border: none;
                border-radius: 8px;
                padding: .6rem 1.2rem;
                font-weight: 500;
                transition: .2s;
            }

            .btn-matte:hover {
                background: #111827;
            }
        </style>

        <h3 class="mb-4 text-center fw-bold">Comentarios de nuestros clientes</h3>

        <div class="carousel-wrapper">
            <div id="comentariosTrack" class="carousel-track">
                @foreach ([['txt' => '“Encontré empleo en menos de dos semanas. El proceso fue claro y rápido.”', 'name' => 'María Gómez', 'role' => 'Diseñadora'], ['txt' => '“Las alertas de plazas me ayudaron a aplicar a tiempo. Súper recomendado.”', 'name' => 'Carlos Pérez', 'role' => 'Técnico Soporte'], ['txt' => '“Me gustó la facilidad para crear mi CV y postularme desde el celular.”', 'name' => 'Lucía Torres', 'role' => 'Administrativa'], ['txt' => '“Gracias a la plataforma pude encontrar una plaza en mi ciudad sin complicaciones.”', 'name' => 'Juan Ramírez', 'role' => 'Contador'], ['txt' => '“Excelente sitio, fácil de usar y con muchas oportunidades.”', 'name' => 'Ana Martínez', 'role' => 'Programadora'], ['txt' => '“El registro fue sencillo y pude subir mi CV en minutos.”', 'name' => 'Pedro López', 'role' => 'Ingeniero']] as $t)
                    <div class="testi-bubble">
                        <div class="testi-text">{{ $t['txt'] }}</div>
                        <div class="testi-author">
                            <div class="testi-avatar"><i class="bi bi-person-fill"></i></div>
                            <div class="d-flex flex-column">
                                <span class="testi-name">{{ $t['name'] }}</span>
                                <span class="testi-role">{{ $t['role'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Agregar nuevo comentario --}}
        <div class="mt-5">
            <h5 class="mb-3">Agregar un nuevo comentario</h5>
            <form method="POST" action="#">
                @csrf
                <div class="mb-3">
                    <textarea class="form-control" rows="4" placeholder="Escribe aquí tu experiencia o comentario..."></textarea>
                </div>
                <button type="submit" class="btn-matte">Enviar</button>
            </form>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const track = document.getElementById("comentariosTrack");
                const items = track.children;
                const itemWidth = items[0].offsetWidth + 24;
                let index = 0;

                setInterval(() => {
                    index++;
                    track.style.transform = `translateX(-${index * itemWidth}px)`;
                    setTimeout(() => {
                        track.appendChild(track.firstElementChild);
                        track.style.transition = "none";
                        track.style.transform = `translateX(-${(index-1) * itemWidth}px)`;
                        setTimeout(() => {
                            track.style.transition = "transform 0.6s ease";
                        }, 50);
                        index--;
                    }, 650);
                }, 3000);
            });
        </script>
    </section>
@endsection

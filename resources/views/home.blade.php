@extends('layouts.app')

@section('content')
    {{-- ================= HERO / BUSCADOR ================= --}}
    <div class="position-relative mb-5">
        <img src="{{ asset('assets/images/banner.jpg') }}" class="w-100" style="height:420px;object-fit:cover;" alt="Banner">
        <div class="position-absolute top-50 start-50 translate-middle w-100 px-3">
            <div class="mx-auto hero-panel p-4 p-md-5 text-center">
                <h2 class="fw-bold mb-2">
                    Encuentra tu próxima oportunidad laboral
                </h2>

                <p class="text-muted mb-4">
                    Plazas actualizadas diariamente en Honduras
                </p>

                <form action="{{ route('user.plazas') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <select class="form-select rounded-pill">
                            <option selected disabled>Área</option>
                            <option>Administración</option>
                            <option>Informática</option>
                            <option>Ventas</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <select class="form-select rounded-pill">
                            <option selected disabled>Cargo</option>
                            <option>Asistente</option>
                            <option>Supervisor</option>
                            <option>Programador</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <select class="form-select rounded-pill">
                            <option selected disabled>Departamento</option>
                            <option>Francisco Morazán</option>
                            <option>Cortés</option>
                            <option>Atlántida</option>
                        </select>
                    </div>

                    <div class="col-12 d-grid">
                        <button class="btn btn-primary btn-lg rounded-pill">
                            Buscar empleos
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ================= ULTIMAS PLAZAS ================= --}}
    <section class="mb-5">
        <h3 class="fw-bold text-center mb-1">Últimas plazas publicadas</h3>
        <p class="text-muted text-center mb-4">
            Oportunidades recientes que podrían interesarte
        </p>

        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

                @foreach ([['titulo' => 'Asistente Administrativo', 'ubicacion' => 'Tegucigalpa', 'fecha' => '1 día', 'actividad' => 'Financiero', 'categoria' => 'Administración'], ['titulo' => 'Técnico en Soporte', 'ubicacion' => 'Santa Ana', 'fecha' => '2 días', 'actividad' => 'Soporte TI', 'categoria' => 'Tecnología'], ['titulo' => 'Diseñador Gráfico', 'ubicacion' => 'La Ceiba', 'fecha' => '3 días', 'actividad' => 'Creativo', 'categoria' => 'Diseño']] as $p)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm plaza-card">
                            <div class="card-body">
                                <h5 class="fw-bold mb-2">{{ $p['titulo'] }}</h5>

                                <p class="mb-1"><i class="bi bi-geo-alt me-1"></i>{{ $p['ubicacion'] }}</p>
                                <p class="mb-1"><strong>Actividad:</strong> {{ $p['actividad'] }}</p>
                                <p class="mb-2"><strong>Categoría:</strong> {{ $p['categoria'] }}</p>
                                <p class="small text-muted">Publicado hace {{ $p['fecha'] }}</p>

                                <a href="{{ route('user.plazas') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                                    Ver detalles
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= VISION / MISION / OBJETIVO ================= --}}
    <section class="vm-section mb-5">
        <div class="container">
            <h3 class="text-center fw-bold mb-1">Visión · Misión · Objetivo</h3>
            <p class="text-center text-muted mb-4">
                El propósito que guía nuestro trabajo
            </p>
            <div class="row g-4">
                @foreach ([['icon' => 'eye', 'title' => 'Visión', 'text' => 'Ser la plataforma líder que conecta talento con oportunidades laborales.'], ['icon' => 'flag', 'title' => 'Misión', 'text' => 'Facilitar el acceso a empleo con procesos simples y modernos.'], ['icon' => 'bullseye', 'title' => 'Objetivo', 'text' => 'Optimizar la búsqueda y postulación laboral.']] as $v)
                    <div class="col-md-4">
                        <div class="vm-card text-center h-100">
                            <div class="vm-icon mb-3">
                                <i class="bi bi-{{ $v['icon'] }}"></i>
                            </div>
                            <h5 class="fw-bold">{{ $v['title'] }}</h5>
                            <p class="text-muted mb-0">{{ $v['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= COMENTARIOS (SIN SCROLL HORIZONTAL) ================= --}}
    <section class="mb-5">
        <div class="container">
            <h3 class="text-center fw-bold mb-4">Comentarios de nuestros usuarios</h3>
            <div class="carousel-viewport">
                <div class="carousel-wrapper">
                    <div id="carouselTrack" class="carousel-track">
                        @foreach ([['txt' => 'Encontré empleo rápidamente.', 'name' => 'María Gómez', 'role' => 'Diseñadora'], ['txt' => 'Muy fácil de usar.', 'name' => 'Carlos Pérez', 'role' => 'Soporte TI'], ['txt' => 'Postulé desde el celular.', 'name' => 'Lucía Torres', 'role' => 'Administrativa'], ['txt' => 'Excelente plataforma.', 'name' => 'Juan Ramírez', 'role' => 'Contador'], ['txt' => 'Recomendada al 100%.', 'name' => 'Ana Martínez', 'role' => 'Programadora']] as $c)
                            <div class="comment-card">
                                <p class="mb-3">“{{ $c['txt'] }}”</p>
                                <div class="comment-user">
                                    <div class="avatar"><i class="bi bi-person-fill"></i></div>
                                    <div>
                                        <strong>{{ $c['name'] }}</strong><br>
                                        <span class="small text-muted">{{ $c['role'] }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= AGREGAR COMENTARIO ================= --}}
    <section class="mb-5">
        <div class="container">
            <div class="comment-form-card mx-auto text-center">
                <h5 class="fw-bold mb-4">
                    Déjanos tu comentario
                </h5>

                <form method="POST" action="#">
                    @csrf

                    <div class="mb-4">
                        <textarea class="form-control comment-textarea" rows="3" placeholder="Escribe tu experiencia con JC Empleos..."
                            required></textarea>
                    </div>

                    <button class="btn btn-comment">
                        💬 Enviar comentario
                    </button>
                </form>
            </div>
        </div>
    </section>

    {{-- ================= ESTILOS ================= --}}
    <style>
        .hero-panel {
            max-width: 760px;
            background: rgba(255, 255, 255, .70);
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .25);
        }

        .plaza-card {
            transition: .2s ease;
        }

        .plaza-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, .12);
        }

        .vm-section {
            background: #f9fafb;
            padding: 3rem 0;
        }

        .vm-card {
            background: #fff;
            border-radius: 18px;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .06);
            transition: .25s;
        }

        .vm-card:hover {
            transform: translateY(-6px);
        }

        .vm-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #e0f2fe;
            color: #0284c7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
        }

        .carousel-viewport {
            width: 100%;
            max-width: 100%;
            overflow: hidden;
        }

        .carousel-wrapper {
            width: 100%;
            max-width: 100%;
            overflow: hidden;
            position: relative;
        }

        .carousel-track {
            display: flex;
            gap: 1.5rem;
            white-space: nowrap;
            will-change: transform;
        }

        .comment-card {
            flex: 0 0 260px;
            width: 260px;
            max-width: 260px;
        }

        .comment-user {
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #2563eb;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .comment-textarea {
            border-radius: 18px;
            padding: 1rem 1.25rem;
            resize: none;
        }

        .btn-comment {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .55rem 1.5rem;
            border-radius: 999px;
            background: #0d6efd;
            color: #fff;
            font-weight: 600;
            font-size: .95rem;
            border: none;
            transition: all .25s ease;
            box-shadow: 0 8px 20px rgba(13, 110, 253, .25);
        }

        .btn-comment:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(13, 110, 253, .35);
        }

        /.btn-comment:active {
            transform: translateY(0);
            box-shadow: 0 6px 14px rgba(13, 110, 253, .2);
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const track = document.getElementById("carouselTrack");
            const originalCards = Array.from(track.children);

            // Clonar una sola vez
            originalCards.forEach(card => {
                track.appendChild(card.cloneNode(true));
            });

            const cardWidth = originalCards[0].offsetWidth;
            const gap = 24; // 1.5rem
            const setWidth = (cardWidth + gap) * originalCards.length;

            let position = 0;
            const speed = 0.35;

            function animate() {
                position -= speed;

                if (Math.abs(position) >= setWidth) {
                    position = 0;
                }

                track.style.transform = `translateX(${position}px)`;
                requestAnimationFrame(animate);
            }
            animate();
        });
    </script>
@endsection

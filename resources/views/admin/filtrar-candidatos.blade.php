@extends('layouts.admin')

@section('content')
<h2 class="mb-4 text-primary">Filtrar Candidatos</h2>

<!-- Formulario de filtros -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form class="row g-3 align-items-end">

        <div class="col-md-4">
                <label class="form-label">Nombre candidato</label>
                <input type="text" class="form-control" placeholder="Buscar entre candidatos">
            </div>
            <div class="col-md-3">
                
                <label class="form-label">Cargo aplicado</label>
                <select class="form-select">
                    <option selected disabled>Seleccione un cargo</option>
                    <option>Programador Web</option>
                    <option>Diseñador Gráfico</option>
                    <option>Analista de Datos</option>
                </select>
            </div>
            

            <div class="col-md-3">
                <label class="form-label">Departamento</label>
                <select class="form-select">
                    <option selected disabled>Seleccione un departamento</option>
                    <option>Francisco Morazán</option>
                    <option>Cortés</option>
                    <option>Atlántida</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label">Ciudad</label>
                <select class="form-select">
                    <option selected disabled>Seleccione una ciudad</option>
                    <option>Tegucigalpa</option>
                    <option>San Pedro Sula</option>
                    <option>La Ceiba</option>
                </select>
            </div>

            <div class="col-md-1">
                <label class="form-label">Edad mínima</label>
                <input type="number" class="form-control" >
            </div>
            <div class="col-md-1">
                <label class="form-label">Edad máxima</label>
                <input type="number" class="form-control" >
            </div>

            <div class="col-md-2">
                <label class="form-label">Desde</label>
                <input type="date" class="form-control">
            </div>
            <div class="col-md-2">
                <label class="form-label">Hasta</label>
                <input type="date" class="form-control">
            </div>

            <div class="col-md-2">
                <label class="form-label">Sexo</label>
                <select class="form-select">
                    <option selected>Todos</option>
                    <option>Masculino</option>
                    <option>Femenino</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Vehículo</label>
                <select class="form-select">
                    <option selected>Todos</option>
                    <option>Ninguno</option>
                    <option>Carro</option>
                    <option>Moto</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label">Aspiración salarial</label>
                <input type="text" class="form-control" placeholder="Ej. 15000">
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100 mt-3">
                    <i class="bi bi-search"></i> Aplicar filtros
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Tabla de resultados -->
 <div class="d-flex justify-content-end mb-3 d-print-none">
  <button id="btnImprimirResultados" class="btn btn-dark">
    <i class="bi bi-printer me-1"></i> Imprimir resultados
  </button>
</div>
<div class="table-responsive">
    <table class="table table-bordered align-middle shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Cargo</th>
                
                <th>Ciudad</th>
                <th>Edad</th>
                
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ([
                ['id' => 1, 'nombre' => 'Carlos Martínez', 'cargo' => 'Programador Web', 'ciudad' => 'Tegucigalpa', 'edad' => 28, 'estado' => 'Nuevo'],
                ['id' => 2, 'nombre' => 'Ana Gómez', 'cargo' => 'Diseñador Gráfico', 'ciudad' => 'San Pedro Sula', 'edad' => 32, 'estado' => 'Revisado'],
            ] as $candidato)
            <tr>
                <td>{{ $candidato['id'] }}</td>
                <td>{{ $candidato['nombre'] }}</td>
                <td>{{ $candidato['cargo'] }}</td>
                <td>{{ $candidato['ciudad'] }}</td>
                <td>{{ $candidato['edad'] }}</td>
                
                <td>
                    <!-- Solo acción de ver perfil -->
                    <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#perfilModal{{ $candidato['id'] }}">
                        <i class="bi bi-eye-fill"></i>
                    </button>
                </td>
            </tr>

<!-- Modal de perfil del candidato (con tabs + imprimir) -->
<div class="modal fade" id="perfilModal{{ $candidato['id'] }}" tabindex="-1" aria-labelledby="perfilLabel{{ $candidato['id'] }}" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="perfilLabel{{ $candidato['id'] }}">
          Perfil de {{ $candidato['nombre'] ?? '—' }}
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body">
        <!-- Tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pane-personal-{{ $candidato['id'] }}" type="button" role="tab">Personal</button></li>
          <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#pane-academica-{{ $candidato['id'] }}" type="button" role="tab">Académica</button></li>
          <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#pane-experiencia-{{ $candidato['id'] }}" type="button" role="tab">Experiencia</button></li>
          <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#pane-idiomas-{{ $candidato['id'] }}" type="button" role="tab">Idiomas</button></li>
        </ul>

        <div class="tab-content pt-3">
          <!-- PERSONAL -->
@php
  // Tomar valores de forma segura (soporta array/objeto)
  $cid             = data_get($candidato, 'id');
  $nombres         = data_get($candidato, 'nombres') ?? data_get($candidato, 'nombre'); // por compatibilidad
  $apellidos       = data_get($candidato, 'apellidos');
  $fechaNac        = data_get($candidato, 'fecha_nacimiento');
  $sexo            = data_get($candidato, 'sexo');
  $telefono        = data_get($candidato, 'telefono');
  $correo          = data_get($candidato, 'correo');
  $vehiculo        = data_get($candidato, 'vehiculo'); // 'ninguno', 'carro', 'moto'...
  $departamento    = data_get($candidato, 'departamento');
  $ciudad          = data_get($candidato, 'ciudad');
  $aspiracion      = data_get($candidato, 'salario');
  $cargoAplicado   = data_get($candidato, 'cargo');
  $fechaPostulacion= data_get($candidato, 'fecha');

  // Edad: usa 'edad' si viene; si no, calcula desde fecha_nacimiento
  $edad = data_get($candidato, 'edad');
  if (!$edad && $fechaNac) {
    try {
      $edad = \Carbon\Carbon::parse($fechaNac)->age;
    } catch (\Throwable $e) { $edad = null; }
  }
@endphp

<div class="tab-pane fade show active" id="pane-personal-{{ $cid }}" role="tabpanel">
  <div class="row g-3 align-items-start">
    <div class="col-md-8">
      <div class="row g-3">
        <div class="col-md-6"><strong>Nombres:</strong> {{ $nombres ?? '—' }}</div>
        <div class="col-md-6"><strong>Apellidos:</strong> {{ $apellidos ?? '—' }}</div>

        <div class="col-md-6">
          <strong>Fecha de nacimiento:</strong>
          {{ $fechaNac ? \Carbon\Carbon::parse($fechaNac)->format('d/m/Y') : '—' }}
        </div>
        <div class="col-md-6"><strong>Edad:</strong> {{ $edad ?? '—' }}</div>

        <div class="col-md-6"><strong>Sexo:</strong> {{ $sexo ? ucfirst($sexo) : '—' }}</div>
        <div class="col-md-6"><strong>Teléfono:</strong> {{ $telefono ?? '—' }}</div>

        <div class="col-md-6"><strong>Correo:</strong> {{ $correo ?? '—' }}</div>
        <div class="col-md-6"><strong>Vehículo:</strong> {{ $vehiculo ? ucfirst($vehiculo) : '—' }}</div>

        <div class="col-md-6"><strong>Departamento:</strong> {{ $departamento ?? '—' }}</div>
        <div class="col-md-6"><strong>Ciudad:</strong> {{ $ciudad ?? '—' }}</div>

        <div class="col-md-6">
          <strong>Aspiración salarial:</strong>
          {{ is_numeric($aspiracion) ? ('L. '.number_format($aspiracion, 2)) : ($aspiracion ?? '—') }}
        </div>
        <div class="col-md-6"><strong>Cargo aplicado:</strong> {{ $cargoAplicado ?? '—' }}</div>

        <div class="col-md-6">
          <strong>Fecha de postulación:</strong>
          {{ $fechaPostulacion ? \Carbon\Carbon::parse($fechaPostulacion)->format('d/m/Y') : '—' }}
        </div>
      </div>

      <hr>
      <p class="mb-1">
        <strong>Resumen profesional:</strong>
        Experiencia simulada en el área de {{ $cargoAplicado ? strtolower($cargoAplicado) : '—' }}.
      </p>
    </div>

    <div class="col-md-4 text-end">
      <img src="{{ asset('assets/images/default-user.jpg') }}" alt="Foto de perfil"
           class="img-fluid rounded-circle shadow" style="width: 150px;">
    </div>
  </div>
</div>


          <!-- ACADÉMICA -->
          <div class="tab-pane fade" id="pane-academica-{{ $candidato['id'] }}" role="tabpanel">
            @forelse(($candidato['formacion'] ?? []) as $edu)
              <div class="border rounded p-3 mb-3">
                <div class="d-flex justify-content-between flex-wrap">
                  <div>
                    <strong>{{ $edu['institucion'] ?? '—' }}</strong>
                    <div class="text-muted small">{{ $edu['nivel'] ?? '—' }} · {{ $edu['area'] ?? '—' }} · {{ $edu['pais'] ?? '—' }}</div>
                  </div>
                  <div class="text-nowrap">
                    <small>
                      {{ isset($edu['desde']) ? \Carbon\Carbon::parse($edu['desde'].'-01')->format('m/Y') : '—' }} —
                      {{ isset($edu['hasta']) ? \Carbon\Carbon::parse($edu['hasta'].'-01')->format('m/Y') : '—' }}
                    </small>
                  </div>
                </div>
              </div>
            @empty
              <p class="text-muted">Sin registros académicos.</p>
            @endforelse
          </div>

          <!-- EXPERIENCIA -->
          <div class="tab-pane fade" id="pane-experiencia-{{ $candidato['id'] }}" role="tabpanel">
            @forelse(($candidato['experiencia'] ?? []) as $exp)
              <div class="border rounded p-3 mb-3">
                <div class="d-flex justify-content-between flex-wrap">
                  <div>
                    <strong>{{ $exp['cargo_operaba'] ?? '—' }}</strong>
                    <div class="text-muted small">{{ $exp['patrono'] ?? '—' }} · {{ $exp['pais'] ?? '—' }}</div>
                    <div class="small">
                      <strong>Actividad:</strong> {{ $exp['actividad'] ?? '—' }} |
                      <strong>Categoría:</strong> {{ $exp['categoria'] ?? '—' }} |
                      <strong>Cargo (según categoría):</strong> {{ $exp['cargo_categoria'] ?? '—' }}
                    </div>
                  </div>
                  <div class="text-nowrap">
                    <small>
                      {{ isset($exp['desde']) ? \Carbon\Carbon::parse($exp['desde'].'-01')->format('m/Y') : '—' }} —
                      {{ !empty($exp['actual']) && $exp['actual'] ? 'Actual' : (isset($exp['hasta']) ? \Carbon\Carbon::parse($exp['hasta'].'-01')->format('m/Y') : '—') }}
                    </small>
                  </div>
                </div>
              </div>
            @empty
              <p class="text-muted">Sin registros de experiencia.</p>
            @endforelse
          </div>

          <!-- IDIOMAS -->
          <div class="tab-pane fade" id="pane-idiomas-{{ $candidato['id'] }}" role="tabpanel">
            @php $idiomas = $candidato['idiomas'] ?? []; @endphp
            @if(empty($idiomas))
              <p class="text-muted">Sin idiomas registrados.</p>
            @else
              <ul class="list-group">
                @foreach($idiomas as $idi)
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $idi['idioma'] ?? '—' }}</span>
                    <span class="badge bg-secondary">{{ $idi['nivel'] ?? '—' }}</span>
                  </li>
                @endforeach
              </ul>
            @endif
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <small class="text-muted me-auto">
          <!-- Si en esta vista tienes fecha/cargo, puedes mostrarlos aquí -->
          Candidato: {{ $candidato['nombre'] ?? '—' }}
        </small>

        <button type="button"
                class="btn btn-dark btn-print-cv"
                data-id="{{ $candidato['id'] }}">
          <i class="bi bi-printer me-1"></i> Imprimir currículum
        </button>

        <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>




            @endforeach
        </tbody>
    </table>
</div>

<script>
    function guardarHistorialSimulado(id) {
        const contenido = document.getElementById(`historial-${id}`).value;

        if (!contenido.trim()) {
            Swal.fire({
                icon: 'warning',
                title: 'Campo vacío',
                text: 'Por favor, escribe algo en el historial antes de guardar.',
                confirmButtonColor: '#d33',
            });
            return;
        }

        Swal.fire({
            icon: 'success',
            title: 'Historial guardado',
            text: 'Tu comentario fue registrado correctamente.',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#198754',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        });
    }
</script>




@endsection


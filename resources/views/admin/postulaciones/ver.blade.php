@extends('layouts.admin')

@section('content')

<!-- Filtro de Apto / No Apto -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Filtrar por Estado</label>
                <select class="form-select">
                    <option selected>Todos</option>
                    <option>Nuevo</option>
                    <option>Revisado - Apto</option>
                    <option>Revisado - No Apto</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-primary w-100">
                    <i class="bi bi-funnel-fill me-1"></i> Filtrar
                </button>
            </div>
        </form>
    </div>
</div>




    <h2 class="mb-4 text-primary">Postulantes para la Plaza: <span class="text-dark">{{ $plaza['cargo'] }}</span></h2>

    <div class="d-flex gap-2 mb-4">
  <a href="{{ route('admin.postulaciones.index') }}" class="btn btn-outline-secondary d-print-none">
      <i class="bi bi-arrow-left"></i> Volver a Plazas
  </a>

  <button id="btnImprimir" class="btn btn-dark d-print-none">
      <i class="bi bi-printer me-1"></i> Imprimir reporte
  </button>
</div>


    <div class="table-responsive">
        <table class="table table-bordered shadow-sm align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre del Candidato</th>
                    <th>Ciudad</th>
                    <th>Fecha de Postulación</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                    <th>Comentario</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($postulantes as $postulante)
                    <tr>
                        <td>{{ $postulante['id'] }}</td>
                        <td>{{ $postulante['nombre'] }}</td>
                        <td>{{ $postulante['ciudad'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($postulante['fecha'])->format('d/m/Y') }}</td>
                        <td>
                        <span id="estado-{{ $postulante['id'] }}"
                                class="badge {{ ($postulante['estado'] ?? 'Nuevo') === 'Nuevo' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ($postulante['estado'] ?? 'Nuevo') === 'Nuevo' ? 'Nuevo' : 'Revisado' }}
                        </span>
                        <br>
                        <small>
                            <span id="resultado-{{ $postulante['id'] }}"
                                class="badge
                                    @if(($postulante['resultado'] ?? null) === 'Apto') bg-success
                                    @elseif(($postulante['resultado'] ?? null) === 'No Apto') bg-danger
                                    @else bg-secondary @endif">
                            {{ $postulante['resultado'] ?? 'Sin evaluación' }}
                            </span>
                        </small>
                        </td>
                        




<td id="acciones-{{ $postulante['id'] }}" class="d-flex gap-1">
  <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#perfilModal{{ $postulante['id'] }}">
    <i class="bi bi-eye-fill"></i>
  </button>
  <div class="btn-group btn-group-sm" role="group">
    <button type="button" class="btn btn-outline-success btn-apto" data-id="{{ $postulante['id'] }}">Apto</button>
    <button type="button" class="btn btn-outline-danger btn-noapto" data-id="{{ $postulante['id'] }}">No Apto</button>
  </div>
</td>

<td>
    <div class="d-flex flex-column gap-1">
        <textarea class="form-control form-control-sm"
                  rows="2"
                  placeholder="Escriba un comentario..."></textarea>

        <button type="button"
                class="btn btn-sm btn-outline-primary">
            <i class="bi bi-save me-1"></i> Guardar
        </button>
    </div>
</td>







                    </tr>
@php
    // ID único para modal y tabs
    $id = $id ?? data_get($postulante, 'id') ?? uniqid('pf_');

    // Fecha de postulación
    $fecha = $fecha ?? data_get($postulante, 'fecha');

    // Plaza aplicada
    $plazaCargo = $plazaCargo
        ?? data_get($plaza ?? [], 'cargo')
        ?? '—';

    // Datos personales
    $nombres       = data_get($postulante, 'nombres', '—');
    $apellidos     = data_get($postulante, 'apellidos', '—');
    $fecha_nac     = data_get($postulante, 'fecha_nacimiento');
    $sexo          = data_get($postulante, 'sexo', '—');
    $telefono      = data_get($postulante, 'telefono', '—');
    $correo        = data_get($postulante, 'correo', '—');
    $vehiculo      = data_get($postulante, 'vehiculo', '—');
    $departamento  = data_get($postulante, 'departamento', '—');
    $ciudad        = data_get($postulante, 'ciudad', '—');
    $salario       = data_get($postulante, 'salario');

    // Listas
    $formacion     = data_get($postulante, 'formacion', []);
    $experiencia   = data_get($postulante, 'experiencia', []);
    $idiomas       = data_get($postulante, 'idiomas', []);
@endphp


<!-- Modal de perfil del postulante (solo visualización) -->
<div class="modal fade" id="perfilModal{{ $postulante['id'] }}" tabindex="-1" aria-labelledby="perfilLabel{{ $postulante['id'] }}" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="perfilLabel{{ $postulante['id'] }}">
          Perfil de {{ $postulante['nombre'] ?? '—' }}
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body">
        <!-- Tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pane-personal-{{ $postulante['id'] }}" type="button" role="tab">Personal</button></li>
          <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#pane-academica-{{ $postulante['id'] }}" type="button" role="tab">Académica</button></li>
          <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#pane-experiencia-{{ $postulante['id'] }}" type="button" role="tab">Experiencia</button></li>
          <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#pane-idiomas-{{ $postulante['id'] }}" type="button" role="tab">Idiomas</button></li>
        </ul>

        <div class="tab-content pt-3">
          <!-- PERSONAL -->
<div class="tab-pane fade show active" id="pane-personal-{{ $id }}" role="tabpanel">
  <div class="row g-3 align-items-start">
    <div class="col-md-8">
      <div class="row g-3">
        <div class="col-md-6"><strong>Nombres:</strong> {{ data_get($postulante, 'nombres', '—') }}</div>
        <div class="col-md-6"><strong>Apellidos:</strong> {{ data_get($postulante, 'apellidos', '—') }}</div>
        <div class="col-md-6"><strong>Fecha de nacimiento:</strong> 
          {{ data_get($postulante, 'fecha_nacimiento') 
              ? \Carbon\Carbon::parse($postulante['fecha_nacimiento'])->format('d/m/Y') 
              : '—' }}
        </div>
        <div class="col-md-6"><strong>Sexo:</strong> {{ ucfirst(data_get($postulante, 'sexo', '—')) }}</div>
        <div class="col-md-6"><strong>Teléfono:</strong> {{ data_get($postulante, 'telefono', '—') }}</div>
        <div class="col-md-6"><strong>Correo:</strong> {{ data_get($postulante, 'correo', '—') }}</div>
        <div class="col-md-6"><strong>Vehículo:</strong> {{ ucfirst(data_get($postulante, 'vehiculo', '—')) }}</div>
        <div class="col-md-6"><strong>Departamento:</strong> {{ data_get($postulante, 'departamento', '—') }}</div>
        <div class="col-md-6"><strong>Ciudad:</strong> {{ data_get($postulante, 'ciudad', '—') }}</div>
        <div class="col-md-6"><strong>Aspiración salarial:</strong> 
          {{ data_get($postulante, 'salario') ? 'L. '.number_format($postulante['salario'], 2) : '—' }}
        </div>
        <div class="col-md-6"><strong>Fecha de postulación:</strong> 
          {{ $fecha ? \Carbon\Carbon::parse($fecha)->format('d/m/Y') : '—' }}
        </div>
        <div class="col-md-6"><strong>Plaza aplicada:</strong> {{ $plazaCargo }}</div>
      </div>
      <hr>
      <p class="mb-1"><strong>Resumen profesional:</strong> Candidato con experiencia en el área de {{ $plazaCargo !== '—' ? strtolower($plazaCargo) : '—' }}.</p>
    </div>
    <div class="col-md-4 text-end">
      <img src="{{ asset('assets/images/default-user.jpg') }}" alt="Foto de perfil" 
           class="img-fluid rounded-circle shadow" style="width: 150px;">
    </div>
  </div>
</div>


          <!-- ACADÉMICA -->
          <div class="tab-pane fade" id="pane-academica-{{ $postulante['id'] }}" role="tabpanel">
            @forelse(($postulante['formacion'] ?? []) as $edu)
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
          <div class="tab-pane fade" id="pane-experiencia-{{ $postulante['id'] }}" role="tabpanel">
            @forelse(($postulante['experiencia'] ?? []) as $exp)
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
          <div class="tab-pane fade" id="pane-idiomas-{{ $postulante['id'] }}" role="tabpanel">
            @php $idiomas = $postulante['idiomas'] ?? []; @endphp
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
    Plaza: {{ $plaza['cargo'] ?? '—' }} ·
    Postulación: {{ isset($postulante['fecha']) ? \Carbon\Carbon::parse($postulante['fecha'])->format('d/m/Y') : '—' }}
  </small>

  <button type="button"
          class="btn btn-dark btn-print-cv"
          data-id="{{ $postulante['id'] }}">
    <i class="bi bi-printer me-1"></i> Imprimir currículum
  </button>

  <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
</div>

    </div>
  </div>
</div>


                            </div>
                        </div>
                    </div>

                @endforeach
            </tbody>
        </table>
    </div>

    @push('scripts')
<script>
(function () {
  function setEstadoRevisado(id) {
    const b = document.getElementById('estado-' + id);
    if (!b) return;
    b.classList.remove('bg-success'); // "Nuevo"
    b.classList.add('bg-secondary');  // "Revisado"
    b.textContent = 'Revisado';
  }

  function setResultado(id, val) {
    const r = document.getElementById('resultado-' + id);
    if (!r) return;
    r.classList.remove('bg-success','bg-danger','bg-secondary');
    if (val === 'Apto') r.classList.add('bg-success');
    else if (val === 'No Apto') r.classList.add('bg-danger');
    else r.classList.add('bg-secondary');
    r.textContent = val || 'Sin evaluación';
  }

  function marcarBotones(id, apto) {
    const td = document.getElementById('acciones-' + id);
    if (!td) return;
    const bA = td.querySelector('.btn-apto');
    const bN = td.querySelector('.btn-noapto');
    if (bA && bN) {
      bA.classList.toggle('btn-success', apto);
      bA.classList.toggle('btn-outline-success', !apto);
      bN.classList.toggle('btn-danger', !apto);
      bN.classList.toggle('btn-outline-danger', apto);
    }
  }

  document.addEventListener('click', function (e) {
    const bA = e.target.closest('.btn-apto');
    const bN = e.target.closest('.btn-noapto');

    if (bA) {
      const id = bA.dataset.id;
      setEstadoRevisado(id);
      setResultado(id, 'Apto');
      marcarBotones(id, true);
    }

    if (bN) {
      const id = bN.dataset.id;
      setEstadoRevisado(id);
      setResultado(id, 'No Apto');
      marcarBotones(id, false);
    }
  });
})();
</script>
@endpush


@endsection


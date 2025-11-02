@extends('layouts.admin')

@section('content')
<h2 class="mb-4 text-primary">Plazas Publicadas</h2>

<!-- Filtros -->
<div class="card shadow-sm mb-4">
  <div class="card-body">
    <form class="row g-3 align-items-end">

      <div class="col-md-3">
        <label class="form-label">Nombre de la Plaza</label>
        <select class="form-select" name="cargo">
          <option selected>Todos</option>
          <option>Programador Web</option>
          <option>Diseñador Gráfico</option>
          <option>Asistente Contable</option>
          <option>Administrador de Redes</option>
        </select>
      </div>

      <div class="col-md-3">
        <label class="form-label">Actividad de trabajo</label>
        <select class="form-select" name="actividad">
          <option selected>Todas</option>
          <option>Desarrollo de software</option>
          <option>Creativo</option>
          <option>Financiero</option>
          <option>Soporte técnico</option>
        </select>
      </div>

      <div class="col-md-3">
        <label class="form-label">Categoría laboral</label>
        <select class="form-select" name="categoria">
          <option selected>Todas</option>
          <option>Tecnología</option>
          <option>Diseño</option>
          <option>Contabilidad</option>
          <option>Informática</option>
        </select>
      </div>

      <div class="col-md-3">
        <label class="form-label">Estado</label>
        <select class="form-select" name="estado">
          <option selected>Todos</option>
          <option value="vigentes">Vigentes</option>
          <option value="canceladas">Canceladas</option>
        </select>
      </div>

      <div class="col-md-2">
        <label class="form-label">Desde</label>
        <input type="date" class="form-control" name="desde">
      </div>

      <div class="col-md-2">
        <label class="form-label">Hasta</label>
        <input type="date" class="form-control" name="hasta">
      </div>

      <div class="col-md-2 d-grid">
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-search me-1"></i> Buscar
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Tabla de plazas -->
<div class="table-responsive">
  <table class="table table-bordered shadow-sm align-middle">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Cargo</th>
        <th>Actividad</th>
        <th>Categoría</th>
        <th>Ubicación</th>
        <th>Fecha</th>
        <th>Publicada por</th> {{-- Nueva columna --}}
        <th>Estado</th> {{-- Nueva columna --}}
        <th style="width: 180px;">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ([
        [
          'id'=>1,
          'cargo'=>'Programador Web',
          'actividad'=>'Desarrollo de software',
          'categoria'=>'Tecnología',
          'ciudad'=>'Tegucigalpa',
          'departamento'=>'Francisco Morazán',
          'fecha'=>'2025-08-01',
          'estado'=>1,
          'publicada_por'=>'Juan Pérez (Empleado)'
        ],
        [
          'id'=>2,
          'cargo'=>'Diseñador Gráfico',
          'actividad'=>'Creativo',
          'categoria'=>'Diseño',
          'ciudad'=>'San Pedro Sula',
          'departamento'=>'Cortés',
          'fecha'=>'2025-08-02',
          'estado'=>0,
          'publicada_por'=>'María López (Empleado)'
        ],
      ] as $plaza)
      <tr>
        <td>{{ $plaza['id'] }}</td>
        <td class="fw-semibold">{{ $plaza['cargo'] }}</td>
        <td>{{ $plaza['actividad'] }}</td>
        <td>{{ $plaza['categoria'] }}</td>
        <td>
          <i class="bi bi-geo-alt text-success"></i>
          {{ $plaza['ciudad'] }}, {{ $plaza['departamento'] }}
        </td>
        <td>{{ \Carbon\Carbon::parse($plaza['fecha'])->format('d/m/Y') }}</td>
        <td>{{ $plaza['publicada_por'] }}</td>
        <td>
          <span class="badge {{ $plaza['estado'] ? 'bg-success' : 'bg-secondary' }}">
            {{ $plaza['estado'] ? 'Activa' : 'Inactiva' }}
          </span>
        </td>
        <td>
          <a href="{{ route('admin.postulaciones.ver', ['id' => $plaza['id']]) }}" 
             class="btn btn-sm btn-outline-primary">
            <i class="bi bi-people-fill me-1"></i> Ver Postulantes
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection





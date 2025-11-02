@extends('layouts.admin')

@section('content')
<h2 class="mb-4 text-primary">Plazas con Postulaciones</h2>

<div class="table-responsive">
    <table class="table table-bordered align-middle shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Plaza</th>
                <th>Ciudad</th>
                <th>Estado</th>
                <th>Postulantes</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ([
                ['id' => 1, 'cargo' => 'Programador Web', 'ciudad' => 'Tegucigalpa', 'estado' => 1, 'postulantes' => 2],
                ['id' => 2, 'cargo' => 'Diseñador Gráfico', 'ciudad' => 'San Pedro Sula', 'estado' => 1, 'postulantes' => 1],
            ] as $plaza)
                <tr>
                    <td>{{ $plaza['id'] }}</td>
                    <td>{{ $plaza['cargo'] }}</td>
                    <td>{{ $plaza['ciudad'] }}</td>
                    <td>
                        <span class="badge bg-success">Activo</span>
                    </td>
                    <td>
                        <span class="badge bg-primary">{{ $plaza['postulantes'] }} candidatos</span>
                    </td>
                    <td>
                        <a href="{{ route('admin.postulaciones.ver', $plaza['id']) }}" class="btn btn-outline-info btn-sm">
                            <i class="bi bi-eye-fill me-1"></i> Ver Postulantes
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

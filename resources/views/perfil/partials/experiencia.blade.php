@php
    $experiences = old('experiences', $profile->experiences->toArray() ?? []);
@endphp

@if (count($experiences) === 0)
    @php
        $experiences = [
            [
                'empresa' => '',
                'pais_id' => '',
                'cargo' => '',
                'descripcion' => '',
            ],
        ];
    @endphp
@endif

<div id="experiences-wrapper">

    @foreach ($experiences as $i => $exp)
        <div class="section-card p-4 mb-3 experience-item">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <strong>Experiencia {{ $i + 1 }}</strong>

                @if ($i > 0)
                    <button type="button" class="btn btn-outline-danger btn-sm remove-experience">
                        Eliminar
                    </button>
                @endif
            </div>

            {{-- FILA 1 --}}
            <div class="mb-3">
                <input type="text" name="experiences[{{ $i }}][empresa]" class="form-control"
                    placeholder="Empresa" value="{{ $exp['empresa'] ?? '' }}">
            </div>

            {{-- FILA 2 --}}
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <select name="experiences[{{ $i }}][pais_id]" class="form-select">
                        <option value="">País</option>
                        @foreach ($paises as $pais)
                            <option value="{{ $pais->id }}" @selected(($exp['pais_id'] ?? '') == $pais->id)>
                                {{ $pais->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <input type="text" name="experiences[{{ $i }}][cargo]" class="form-control"
                        placeholder="Cargo" value="{{ $exp['cargo'] ?? '' }}">
                </div>
            </div>

            {{-- FILA 3 --}}
            <div>
                <textarea name="experiences[{{ $i }}][descripcion]" class="form-control" rows="3"
                    placeholder="Descripción de funciones">{{ $exp['descripcion'] ?? '' }}</textarea>
            </div>

        </div>
    @endforeach

</div>

<div class="text-end">
    <button type="button" id="add-experience" class="btn btn-outline-primary btn-sm">
        ➕ Agregar experiencia
    </button>
</div>

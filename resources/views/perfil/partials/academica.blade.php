@php
    $educations = old('educations');

    if (!is_array($educations)) {
        $educations = optional($perfil)->educaciones?->toArray() ?? [];
    }
@endphp



@if (count($educations) === 0)
    @php
        $educations = [
            [
                'institucion' => '',
                'nivel_educativo_id' => '',
                'area_estudio' => '',
                'fecha_desde' => '',
                'fecha_hasta' => '',
            ],
        ];
    @endphp
@endif

<div id="educations-wrapper">

    @foreach ($educations as $i => $edu)
        <div class="section-card p-4 mb-3 education-item">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <strong>Formación {{ $i + 1 }}</strong>

                @if ($i > 0)
                    <button type="button"
                            class="btn btn-outline-danger btn-sm remove-education">
                        Eliminar
                    </button>
                @endif
            </div>

            {{-- FILA 1 --}}
            <div class="mb-3">
                <input type="text"
                       name="educations[{{ $i }}][institucion]"
                       class="form-control"
                       placeholder="Institución"
                       value="{{ $edu['institucion'] ?? '' }}">
            </div>

            {{-- FILA 2 --}}
            <div class="row g-3">
                <div class="col-md-6">
                    <select name="educations[{{ $i }}][nivel_educativo_id]"
                            class="form-select">
                        <option value="">Nivel educativo</option>
                        @foreach ($niveles as $nivel)
                            <option value="{{ $nivel->id }}"
                                @selected(($edu['nivel_educativo_id'] ?? '') == $nivel->id)>
                                {{ $nivel->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <input type="text"
                           name="educations[{{ $i }}][area_estudio]"
                           class="form-control"
                           placeholder="Área de estudio"
                           value="{{ $edu['area_estudio'] ?? '' }}">
                </div>
            </div>

            {{-- FILA 3 --}}
            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <input type="date"
                           name="educations[{{ $i }}][fecha_desde]"
                           class="form-control"
                           value="{{ $edu['fecha_desde'] ?? '' }}">
                </div>

                <div class="col-md-6">
                    <input type="date"
                           name="educations[{{ $i }}][fecha_hasta]"
                           class="form-control"
                           value="{{ $edu['fecha_hasta'] ?? '' }}">
                </div>
            </div>

        </div>
    @endforeach

</div>

<div class="text-end">
    <button type="button"
            id="add-education"
            class="btn btn-outline-primary btn-sm">
        ➕ Agregar formación
    </button>
</div>

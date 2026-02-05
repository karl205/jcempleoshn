@php
    $languages = old('languages');

    if (!is_array($languages)) {
        $languages = optional($perfil)->idiomas?->toArray() ?? [];
    }
@endphp


@if (count($languages) === 0)
    @php
        $languages = [
            [
                'idioma_id' => '',
                'nivel_id' => '',
            ],
        ];
    @endphp
@endif

<div id="languages-wrapper">

    @foreach ($languages as $i => $lang)
        <div class="section-card p-4 mb-3 language-item">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <strong>Idioma {{ $i + 1 }}</strong>

                @if ($i > 0)
                    <button type="button"
                            class="btn btn-outline-danger btn-sm remove-language">
                        Eliminar
                    </button>
                @endif
            </div>

            {{-- FILA ÚNICA --}}
            <div class="row g-3">
                <div class="col-md-6">
                    <select name="languages[{{ $i }}][idioma_id]"
                            class="form-select">
                        <option value="">Selecciona idioma</option>
                        @foreach ($idiomasCat as $idioma)
                            <option value="{{ $idioma->id }}"
                                @selected(($lang['idioma_id'] ?? '') == $idioma->id)>
                                {{ $idioma->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <select name="languages[{{ $i }}][nivel_id]"
                            class="form-select">
                        <option value="">Selecciona nivel</option>
                        @foreach ($nivelesIdioma as $nivel)
                            <option value="{{ $nivel->id }}"
                                @selected(($lang['nivel_id'] ?? '') == $nivel->id)>
                                {{ $nivel->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
    @endforeach

</div>

<div class="text-end">
    <button type="button"
            id="add-language"
            class="btn btn-outline-primary btn-sm">
        ➕ Agregar idioma
    </button>
</div>

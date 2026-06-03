<ul class="nav nav-tabs dash-lang-tabs mb-3" role="tablist">
    @foreach (languages() as $lang)
        <li class="nav-item">
            <button type="button" class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                data-bs-target="#lang-tab-{{ $lang }}" role="tab">
                {{ getLanguageName($lang) }}
            </button>
        </li>
    @endforeach
</ul>
<div class="tab-content mb-3">
    @foreach (languages() as $lang)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="lang-tab-{{ $lang }}" role="tabpanel">
            @isset($fields)
                @foreach ($fields as $field => $config)
                    @php
                        $type = $config['type'] ?? 'text';
                        $baseLabel = $config['label'] ?? "dashboard.{$field}";
                        if (str_contains($baseLabel, '.')) {
                            [$prefix, $key] = explode('.', $baseLabel, 2);
                            $labelKey = str_ends_with($key, "_{$lang}") ? $baseLabel : "{$prefix}.{$key}_{$lang}";
                        } else {
                            $labelKey = "dashboard.{$field}_{$lang}";
                        }
                        $label = __($labelKey);
                        $value = old("{$field}.{$lang}", isset($model) ? $model->getTranslation($field, $lang, false) : '');
                        $required = ($config['required'] ?? false) && $lang === 'ar';
                    @endphp
                    <div class="mb-3">
                        <label class="form-label" for="{{ $field }}_{{ $lang }}">{{ $label }}</label>
                        @if ($type === 'textarea')
                            <textarea class="form-control" id="{{ $field }}_{{ $lang }}" name="{{ $field }}[{{ $lang }}]"
                                rows="{{ $config['rows'] ?? 3 }}" {{ $required ? 'required' : '' }}>{{ $value }}</textarea>
                        @else
                            <input type="text" class="form-control" id="{{ $field }}_{{ $lang }}"
                                name="{{ $field }}[{{ $lang }}]" value="{{ $value }}" {{ $required ? 'required' : '' }}>
                        @endif
                        @if ($errors->has("{$field}.{$lang}"))
                            <div class="text-danger small mt-1">{{ $errors->first("{$field}.{$lang}") }}</div>
                        @endif
                    </div>
                @endforeach
            @endisset
        </div>
    @endforeach
</div>

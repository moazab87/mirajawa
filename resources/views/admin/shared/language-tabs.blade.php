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
                @php
                    $richTextFields = ['description', 'answer', 'map_desc', 'how_to_use', 'storage_conditions', 'notes'];
                @endphp
                @foreach ($fields as $field => $config)
                    @php
                        $type = $config['type'] ?? 'text';
                        if ($type === 'textarea' && in_array($field, $richTextFields, true)) {
                            $type = 'editor';
                        }
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
                        $inputId = "{$field}_{$lang}";
                    @endphp
                    <div class="mb-3 {{ $type === 'editor' ? 'mj-rich-editor-wrap' : '' }}">
                        <label class="form-label" for="{{ $inputId }}">{{ $label }}</label>
                        @if ($type === 'editor')
                            <textarea class="form-control mj-rich-editor" id="{{ $inputId }}" name="{{ $field }}[{{ $lang }}]"
                                rows="{{ $config['rows'] ?? 6 }}" data-lang="{{ $lang }}" {{ $required ? 'required' : '' }}>{{ $value }}</textarea>
                        @elseif ($type === 'textarea')
                            <textarea class="form-control" id="{{ $inputId }}" name="{{ $field }}[{{ $lang }}]"
                                rows="{{ $config['rows'] ?? 3 }}" {{ $required ? 'required' : '' }}>{{ $value }}</textarea>
                        @else
                            <input type="text" class="form-control" id="{{ $inputId }}"
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

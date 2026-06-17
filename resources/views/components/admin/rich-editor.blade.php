@props([
    'name',
    'id' => null,
    'value' => '',
    'label' => null,
    'lang' => 'en',
    'required' => false,
    'rows' => 6,
    'errorKey' => null,
])

@php
    $inputId = $id ?? str_replace(['[', ']', '.'], '_', $name);
    $errorKey = $errorKey ?? $name;
@endphp

<div class="mb-3 mj-rich-editor-wrap">
    @if($label)
        <label class="form-label" for="{{ $inputId }}">{{ $label }}</label>
    @endif
    <textarea
        class="form-control mj-rich-editor"
        id="{{ $inputId }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        data-lang="{{ $lang }}"
        {{ $required ? 'required' : '' }}
    >{{ $value }}</textarea>
    @if ($errors->has($errorKey))
        <div class="text-danger small mt-1">{{ $errors->first($errorKey) }}</div>
    @endif
</div>

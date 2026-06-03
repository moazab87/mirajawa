@props([
    'submitText',
    'backUrl' => null,
    'submitType' => 'submit',
])

<div class="dash-form-actions">
    <button type="{{ $submitType }}" class="btn btn-primary">
        {{ $submitText }}
    </button>
    <a href="{{ $backUrl ?? url()->previous() }}" class="btn btn-secondary">
        <i class="bx bx-arrow-back"></i>
        {{ __('dashboard.back') }}
    </a>
</div>

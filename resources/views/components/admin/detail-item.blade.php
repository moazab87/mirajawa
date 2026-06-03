@props([
    'label',
    'value' => null,
    'icon' => 'bx-info-circle',
    'iconVariant' => 'primary',
    'fullWidth' => false,
])

<div class="dash-detail-item {{ $fullWidth ? 'dash-detail-full' : '' }}">
    <div class="dash-detail-icon icon-{{ $iconVariant }}">
        <i class="bx {{ $icon }}"></i>
    </div>
    <div class="flex-grow-1">
        <div class="dash-detail-label">{{ $label }}</div>
        <div class="dash-detail-value">
            @if(trim($slot) !== '')
                {{ $slot }}
            @else
                {{ $value ?? '—' }}
            @endif
        </div>
    </div>
</div>

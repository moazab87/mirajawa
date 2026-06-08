@props(['title', 'icon' => 'bi-stars', 'align' => 'center', 'description' => null])

<div @class(['mj-info-card', 'mj-info-card--start' => $align === 'start', 'mj-reveal'])>
    <div class="mj-info-card__icon"><i class="bi {{ $icon }}" aria-hidden="true"></i></div>
    <h3 class="mj-info-card__title">{{ $title }}</h3>
    <div class="mj-info-card__body mj-content">
        {!! $description ?? $slot ?? '' !!}
    </div>
</div>

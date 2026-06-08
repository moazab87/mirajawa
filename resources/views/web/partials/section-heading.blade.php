@props(['number' => null, 'label' => null, 'title', 'text' => null, 'align' => 'center'])

<div @class(['mj-section-heading', 'mj-reveal', 'text-start' => $align === 'start'])>
    @if($label)
        <div class="mj-section-heading__label">
            @if($number)<span>{{ $number }}</span>@endif
            {{ $label }}
        </div>
    @endif
    <h2 class="mj-section-heading__title">{{ $title }}</h2>
    <div class="mj-section-heading__accent"></div>
    @if($text)
        <p class="mj-section-heading__text">{{ $text }}</p>
    @endif
</div>

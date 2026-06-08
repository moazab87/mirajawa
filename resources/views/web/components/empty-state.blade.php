@props(['icon' => 'bi-inbox', 'title', 'text' => null])

<div class="mj-empty-state">
    <div class="mj-empty-state__icon"><i class="bi {{ $icon }}"></i></div>
    <h3 class="mj-empty-state__title">{{ $title }}</h3>
    @if($text)
        <p class="mj-empty-state__text">{{ $text }}</p>
    @endif
    {{ $slot ?? '' }}
</div>

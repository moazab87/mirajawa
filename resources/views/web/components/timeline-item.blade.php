@props(['title', 'year' => null, 'description' => null])

<div class="mj-timeline__item mj-reveal">
    @if($year)
        <div class="mj-timeline__year">{{ $year }}</div>
    @endif
    <div class="mj-timeline__card">
        <h3 class="mj-timeline__title">{{ $title }}</h3>
        <div class="mj-content">{!! $description ?? $slot ?? '' !!}</div>
    </div>
</div>

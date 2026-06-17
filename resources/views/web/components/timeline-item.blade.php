@props(['title', 'year' => null, 'description' => null])

<div class="mj-timeline__item mj-reveal">
    <div class="mj-timeline__card">
        @if($year)
            <div class="mj-timeline__year-badge" aria-label="{{ __('website.history') }} {{ $year }}">{{ $year }}</div>
        @endif
        <h3 class="mj-timeline__title">{{ $title }}</h3>
        <div class="mj-content">{!! $description ?? $slot ?? '' !!}</div>
    </div>
</div>

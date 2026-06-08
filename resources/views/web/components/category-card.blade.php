@props(['category'])

<article class="mj-card mj-reveal">
    @if($category->color)
        <div class="mj-card__color-bar" style="background: {{ $category->color }};"></div>
    @endif
    <div class="mj-card__body text-center">
        <div class="mj-info-card__icon mx-auto"><i class="bi bi-grid-3x3-gap" aria-hidden="true"></i></div>
        <h3 class="mj-card__title">{{ $category->name }}</h3>
        @if($category->description)
            <p class="mj-card__text">{{ Str::limit(strip_tags($category->description), 120) }}</p>
        @endif
    </div>
    <div class="mj-card__footer text-center">
        <a href="{{ route('web.products.index', ['category' => $category->id]) }}" class="mj-btn mj-btn--outline mj-btn--sm">
            {{ __('website.view_products') }}
        </a>
    </div>
</article>

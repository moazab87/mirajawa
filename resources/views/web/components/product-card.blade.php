@props(['product'])

<article class="mj-card mj-product-card mj-reveal">
    <a href="{{ route('web.products.show', $product->id) }}" class="mj-card__image" tabindex="-1" aria-hidden="true">
        @if(productImageUrl($product))
            <img src="{{ productImageUrl($product) }}" alt="{{ $product->name }}" loading="lazy">
        @else
            <div class="mj-placeholder-image"><i class="bi bi-box-seam" aria-hidden="true"></i></div>
        @endif
    </a>
    <div class="mj-card__body">
        <div class="d-flex flex-wrap gap-2 mb-2">
            @if($product->category)
                <span class="mj-badge mj-badge--green">{{ $product->category->name }}</span>
            @endif
            @if($product->productGroup)
                <span class="mj-badge">{{ $product->productGroup->name }}</span>
            @endif
        </div>
        <h3 class="mj-card__title">
            <a href="{{ route('web.products.show', $product->id) }}">{{ $product->name }}</a>
        </h3>
        @if($product->description)
            <p class="mj-card__text">{{ Str::limit(strip_tags($product->description), 110) }}</p>
        @endif
    </div>
    <div class="mj-card__footer">
        <a href="{{ route('web.products.show', $product->id) }}" class="mj-btn mj-btn--primary mj-btn--sm w-100">
            {{ __('website.view_details') }} <i class="bi bi-arrow-right" aria-hidden="true"></i>
        </a>
    </div>
</article>

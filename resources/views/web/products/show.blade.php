@extends('web.layouts.app')

@section('title', $product->name . ' | ' . config('app.name'))
@section('meta_description', Str::limit(strip_tags($product->description ?? ''), 160))

@section('content')
    @include('web.partials.page-hero', [
        'title' => $product->name,
        'subtitle' => $product->category->name ?? null,
        'breadcrumbs' => [
            __('website.breadcrumb_home') => route('web.home'),
            __('website.products') => route('web.products.index'),
            $product->name => route('web.products.show', $product->id),
        ],
    ])

    <section class="mj-section mj-section--white">
        <div class="mj-container">
            <div class="row g-5 mj-product-layout">
                <div class="col-lg-6">
                    @php
                        $images = $product->attachments->filter(fn ($a) => str_starts_with((string) $a->mime, 'image/'));
                        $videos = $product->attachments->filter(fn ($a) => str_starts_with((string) $a->mime, 'video/'));
                        $firstImage = $images->first();
                    @endphp

                    @if($images->count())
                        <div class="mj-product-gallery mj-reveal">
                            <div class="mj-product-gallery__main">
                                @if($firstImage)
                                    <a href="{{ attachmentStorageUrl($firstImage, 'products') }}" data-fancybox="product-gallery">
                                        <img src="{{ attachmentStorageUrl($firstImage, 'products') }}" alt="{{ $product->name }}" id="product-main-image" loading="eager">
                                    </a>
                                @endif
                            </div>
                            @if($images->count() > 1)
                                <div class="mj-product-gallery__thumbs">
                                    @foreach($images as $image)
                                        <button type="button" class="mj-product-gallery__thumb border-0 p-0 bg-transparent {{ $loop->first ? 'active' : '' }}"
                                                data-src="{{ attachmentStorageUrl($image, 'products') }}"
                                                aria-label="{{ __('website.images') }} {{ $loop->iteration }}">
                                            <img src="{{ attachmentStorageUrl($image, 'products') }}" alt="" loading="lazy">
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="mj-placeholder-image mj-product-gallery__main mj-reveal">
                            <i class="bi bi-box-seam" aria-hidden="true"></i>
                        </div>
                    @endif

                    @if($videos->count())
                        <div class="mt-4 mj-reveal">
                            <h2 class="mj-label-sm mb-3">{{ __('website.videos') }}</h2>
                            @foreach($videos as $video)
                                <video class="w-100 rounded mb-2" controls style="max-height:320px;border-radius:var(--mj-radius-sm);">
                                    <source src="{{ attachmentStorageUrl($video, 'products') }}" type="{{ $video->mime }}">
                                </video>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="col-lg-6 mj-product-info">
                    <div class="d-flex flex-wrap gap-2 mb-3 mj-reveal">
                        @if($product->category)
                            <span class="mj-badge mj-badge--green">{{ $product->category->name }}</span>
                        @endif
                        @if($product->productGroup)
                            <span class="mj-badge">{{ $product->productGroup->name }}</span>
                        @endif
                    </div>

                    @if($product->description)
                        <div class="mb-4 mj-reveal">
                            <h2 class="h5 mb-3 mj-label-sm">{{ __('website.description') }}</h2>
                            <div class="mj-content">{!! $product->description !!}</div>
                        </div>
                    @endif

                    <div class="mj-spec-panel mj-reveal">
                        <h2 class="mj-spec-panel__title">{{ __('website.product_specifications') }}</h2>
                        <ul class="mj-product-specs">
                            @if($product->category)
                                <li><strong>{{ __('website.category') }}</strong><span>{{ $product->category->name }}</span></li>
                            @endif
                            @if($product->productGroup)
                                <li><strong>{{ __('website.product_group') }}</strong><span>{{ $product->productGroup->name }}</span></li>
                            @endif
                            @foreach([
                                'packaging' => __('website.packaging'),
                                'country_of_origin' => __('website.country_of_origin'),
                                'how_to_use' => __('website.how_to_use'),
                                'storage_conditions' => __('website.storage_conditions'),
                                'expiry_date_text' => __('website.expiry_date'),
                                'harvest_season' => __('website.harvest_season'),
                                'notes' => __('website.notes'),
                            ] as $field => $label)
                                @if($product->{$field})
                                    <li><strong>{{ $label }}</strong><span>{!! $product->{$field} !!}</span></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    <div class="mj-product-actions mj-reveal">
                        <a href="{{ route('web.request-information.create') }}" class="mj-btn mj-btn--primary">
                            <i class="bi bi-file-earmark-text" aria-hidden="true"></i> {{ __('website.request_information') }}
                        </a>
                        <a href="{{ route('web.contact.index') }}" class="mj-btn mj-btn--outline">
                            {{ __('website.contact_us') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($relatedProducts->count())
        <section class="mj-section mj-section--beige">
            <div class="mj-container">
                @include('web.partials.section-heading', ['title' => __('website.related_products')])
                <div class="mj-grid mj-grid--4">
                    @foreach($relatedProducts as $related)
                        @include('web.components.product-card', ['product' => $related])
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (document.querySelector('[data-fancybox="product-gallery"]')) {
            Fancybox.bind('[data-fancybox="product-gallery"]', {});
        }

        document.querySelectorAll('.mj-product-gallery__thumb').forEach(function (thumb) {
            thumb.addEventListener('click', function () {
                const src = this.dataset.src;
                const main = document.getElementById('product-main-image');
                const link = main?.closest('a');
                if (main && src) {
                    main.src = src;
                    if (link) link.href = src;
                }
                document.querySelectorAll('.mj-product-gallery__thumb').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>
@endsection

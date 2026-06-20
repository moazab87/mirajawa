@extends('web.layouts.app')

@section('title', (($welcomePage->name ?? null) ?: config('app.name')) . ' | ' . config('app.name'))
@section('meta_description', Str::limit(strip_tags(($welcomePage->description ?? null) ?: ($aboutPage->description ?? null) ?: __('website.hero_default_subtitle')), 160))

@section('content')


    @if($welcomePage && $welcomePage->description)
        <section id="welcome-section" class="mj-section mj-section--welcome-banner">
            <div class="mj-welcome-banner__overlay" aria-hidden="true"></div>
            <div class="mj-container mj-welcome-banner__content">
                @include('web.partials.section-heading', [
                    'number' => '01',
                    'label' => __('website.welcome'),
                    'title' => $welcomePage->name,
                    'text' => $welcomePage->sub_title,
                ])
                <div class="mj-content mj-content-narrow mj-reveal mj-welcome-banner__text">
                    {!! $welcomePage->description !!}
                </div>
            </div>
        </section>
    @endif
    <section class="mj-hero" aria-label="{{ __('website.home') }}">
        @php
            $bgImage = websiteBackgroundImage();
            $hasSlides = $sliders->count() > 0;
        @endphp

        @if($hasSlides)
            @foreach($sliders as $slider)
                @php $media = sliderMediaUrl($slider); @endphp
                <div class="mj-hero__slide {{ $loop->first ? 'active' : '' }}" @if($loop->first) aria-hidden="false" @else aria-hidden="true" @endif>
                    <div class="mj-hero__media" @if($media && !$media['is_video']) style="background-image:url('{{ $media['url'] }}')" @elseif($bgImage) style="background-image:url('{{ $bgImage }}')" @endif>
                        @if($media && $media['is_video'])
                            <video autoplay muted loop playsinline>
                                <source src="{{ $media['url'] }}" type="{{ $media['mime'] }}">
                            </video>
                        @endif
                    </div>
                    <div class="mj-hero__overlay"></div>
                </div>
            @endforeach
        @else
            <div class="mj-hero__slide active">
                <div class="mj-hero__media" @if($bgImage) style="background-image:url('{{ $bgImage }}')" @endif></div>
                <div class="mj-hero__overlay"></div>
            </div>
        @endif

        <div class="mj-container mj-hero__content">
            @php
                $firstSlider = $sliders->first();
                $heroTitle = $firstSlider?->title ?? $welcomePage?->name ?? __('website.hero_default_title');
                $heroSubtitle = $firstSlider?->description ?? $welcomePage?->description ?? __('website.hero_default_subtitle');
            @endphp
            <span class="mj-hero__eyebrow">{{ config('app.name') }}</span>
            <h1 class="mj-hero__title">{{ $heroTitle }}</h1>
            <p class="mj-hero__subtitle">{!! Str::limit(strip_tags($heroSubtitle), 220) !!}</p>
            <div class="mj-hero__actions">
                <a href="{{ route('web.products.index') }}" class="mj-btn mj-btn--gold mj-btn--lg">
                    <i class="bi bi-box-seam" aria-hidden="true"></i> {{ __('website.view_products') }}
                </a>
                <a href="{{ route('web.request-information.create') }}" class="mj-btn mj-btn--ghost mj-btn--lg">
                    {{ __('website.request_information') }}
                </a>
            </div>
        </div>

        @if($hasSlides && $sliders->count() > 1)
            <div class="mj-hero__dots" role="tablist" aria-label="{{ __('website.hero_slides') }}">
                @foreach($sliders as $slider)
                    <button type="button" class="mj-hero__dot {{ $loop->first ? 'active' : '' }}" role="tab" aria-label="{{ __('website.slide') }} {{ $loop->iteration }}"></button>
                @endforeach
            </div>
        @endif

        <a href="#welcome-section" class="mj-hero__scroll d-none d-md-flex" aria-label="{{ __('website.scroll_down') }}">
            <i class="bi bi-chevron-down" aria-hidden="true"></i>
        </a>
    </section>

    @if($aboutPage || $profiles->count())
        <section class="mj-section mj-section--white">
            <div class="mj-container">
                @include('web.partials.section-heading', [
                    'number' => '02',
                    'label' => __('website.who_we_are'),
                    'title' => $aboutPage?->name ?? __('website.about_us'),
                ])
                <div class="row g-4">
                    @if($aboutPage && $aboutPage->description)
                        <div @class(['mj-reveal', $profiles->count() ? 'col-md-6' : 'col-12'])>
                            <div class="mj-content">{!! $aboutPage->description !!}</div>
                        </div>
                    @endif
                    @foreach($profiles as $profile)
                        <div class="col-md-6">
                            @include('web.components.info-card', [
                                'title' => $profile->name,
                                'icon' => 'bi-building',
                                'align' => 'start',
                                'description' => $profile->description,
                            ])
                        </div>
                    @endforeach
                </div>
                <div class="mj-text-center mj-mt-section">
                    <a href="{{ route('web.about') }}" class="mj-btn mj-btn--outline">{{ __('website.read_more') }}</a>
                </div>
            </div>
        </section>
    @endif

    {{-- @if($informationBlocks->count())
        <section class="mj-section mj-section--white">
            <div class="mj-container">
                @include('web.partials.section-heading', [
                    'number' => '03',
                    'label' => __('website.philosophy'),
                    'title' => __('website.philosophy'),
                ])
                <div class="mj-grid mj-grid--3">
                    @foreach($informationBlocks->take(3) as $block)
                        @include('web.components.info-card', [
                            'title' => $block->name,
                            'icon' => 'bi-gem',
                            'description' => Str::limit(strip_tags($block->description), 220),
                        ])
                    @endforeach
                </div>
            </div>
        </section>
    @endif --}}

    {{-- @if($whyPage || $informationBlocks->count() > 3)
        <section class="mj-section mj-section--beige">
            <div class="mj-container">
                @include('web.partials.section-heading', [
                    'number' => '04',
                    'label' => __('website.why_mirajawa'),
                    'title' => $whyPage?->name ?? __('website.why_mirajawa'),
                    'text' => $whyPage?->sub_title,
                ])
                @if($whyPage && $whyPage->description)
                    <div class="mj-content mj-content-narrow mb-4 mj-reveal">{!! $whyPage->description !!}</div>
                @endif
                <div class="mj-grid mj-grid--3">
                    @foreach($informationBlocks->slice(3) as $block)
                        @include('web.components.info-card', [
                            'title' => $block->name,
                            'icon' => 'bi-shield-check',
                            'description' => Str::limit(strip_tags($block->description), 180),
                        ])
                    @endforeach
                </div>
                <div class="mj-text-center mj-mt-section">
                    <a href="{{ route('web.why-us') }}" class="mj-btn mj-btn--primary">{{ __('website.read_more') }}</a>
                </div>
            </div>
        </section>
    @endif --}}

    {{-- @if($businessPage)
        <section class="mj-section mj-section--white">
            <div class="mj-container">
                @include('web.partials.section-heading', [
                    'number' => '05',
                    'label' => __('website.business'),
                    'title' => $businessPage->name,
                    'text' => $businessPage->sub_title,
                ])
                @if($businessPage->description)
                    <div class="mj-content mj-content-narrow mb-4 mj-reveal">{!! $businessPage->description !!}</div>
                @endif
                <div class="mj-text-center">
                    <a href="{{ route('web.business') }}" class="mj-btn mj-btn--outline">{{ __('website.read_more') }}</a>
                </div>
            </div>
        </section>
    @endif --}}

    @if($categories->count() || $featuredProducts->count())
        <section class="mj-section mj-section--beige">
            <div class="mj-container">
                @include('web.partials.section-heading', [
                    'number' => '06',
                    'label' => __('website.products'),
                    'title' => __('website.featured_products'),
                ])
                @if($categories->count())
                    <div class="mj-grid mj-grid--3 mb-4">
                        @foreach($categories->take(3) as $category)
                            @include('web.components.category-card', ['category' => $category])
                        @endforeach
                    </div>
                @endif
                @if($featuredProducts->count())
                    <div class="mj-grid mj-grid--3">
                        @foreach($featuredProducts as $product)
                            @include('web.components.product-card', ['product' => $product])
                        @endforeach
                    </div>
                @endif
                <div class="mj-text-center mj-mt-section">
                    <a href="{{ route('web.products.index') }}" class="mj-btn mj-btn--primary">{{ __('website.view_all') }}</a>
                </div>
            </div>
        </section>
    @endif

    @if($histories->count())
        <section class="mj-section mj-section--white">
            <div class="mj-container">
                @include('web.partials.section-heading', [
                    'number' => '07',
                    'label' => __('website.history'),
                    'title' => __('website.company_journey'),
                ])
                <div class="mj-timeline mx-auto">
                    @foreach($histories as $history)
                        @include('web.components.timeline-item', [
                            'year' => $history->year,
                            'title' => $history->name,
                            'description' => $history->description,
                        ])
                    @endforeach
                </div>
                <div class="mj-text-center mj-mt-section">
                    <a href="{{ route('web.history') }}" class="mj-btn mj-btn--outline">{{ __('website.view_all') }}</a>
                </div>
            </div>
        </section>
    @endif

    @if($branches->count())
        <section class="mj-section mj-section--beige">
            <div class="mj-container">
                @include('web.partials.section-heading', [
                    'number' => '08',
                    'label' => __('website.branches'),
                    'title' => __('website.facilities'),
                ])
                <div class="row g-4">
                    @foreach($branches as $branch)
                        <div class="col-md-6">
                            <article class="mj-card mj-reveal h-100">
                                <div class="mj-card__image">
                                    @if($branch->images->first())
                                        <img src="{{ $branch->images->first()->image_url }}" alt="{{ $branch->name }}" loading="lazy">
                                    @else
                                        <div class="mj-placeholder-image"><i class="bi bi-building" aria-hidden="true"></i></div>
                                    @endif
                                </div>
                                <div class="mj-card__body">
                                    <h3 class="mj-card__title">{{ $branch->name }}</h3>
                                    <div class="mj-content">{!! Str::limit(strip_tags($branch->description), 140) !!}</div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
                <div class="mj-text-center mj-mt-section">
                    <a href="{{ route('web.branches') }}" class="mj-btn mj-btn--outline">{{ __('website.view_all') }}</a>
                </div>
            </div>
        </section>
    @endif

    @include('web.partials.cta-section')
@endsection

@extends('web.layouts.app')

@section('title', ($page?->name ?? __('website.about_us')) . ' | ' . config('app.name'))
@section('meta_description', Str::limit(strip_tags($page?->description ?? ''), 160))

@section('content')
    @include('web.partials.page-hero', [
        'title' => $page?->name ?? __('website.about_us'),
        'subtitle' => $page?->sub_title ?? null,
        'breadcrumbs' => [
            __('website.breadcrumb_home') => route('web.home'),
            __('website.about_us') => route('web.about'),
        ],
    ])

    <section class="mj-section mj-section--white">
        <div class="mj-container">
            @if($page && $page?->description)
                <div class="mj-content mj-content-wide mb-5 mj-reveal">
                    @if($page?->image_url)
                        <figure class="mj-page-image">
                            <img src="{{ $page?->image_url }}" alt="{{ $page?->name }}" loading="lazy">
                        </figure>
                    @endif
                    {!! $page?->description !!}
                </div>
            @endif

            <section
                class="mj-about-agriculture mj-reveal"
                aria-label="{{ __('website.egyptian_agriculture') }}"
            >
                <div class="mj-about-agriculture__overlay" aria-hidden="true"></div>
                <div class="mj-about-agriculture__content">
                    <span class="mj-about-agriculture__eyebrow">{{ __('website.egyptian_agriculture') }}</span>
                    <h2 class="mj-about-agriculture__title">{{ __('website.from_egyptian_fields_to_japan') }}</h2>
                    <p class="mj-about-agriculture__text">{{ __('website.about_agriculture_story') }}</p>
                </div>
            </section>

            @if($profiles->count())
                @include('web.partials.section-heading', ['title' => __('website.company_overview')])
                <div class="mj-grid mj-grid--2">
                    @foreach($profiles as $profile)
                        @include('web.components.info-card', [
                            'title' => $profile->name,
                            'icon' => 'bi-building',
                            'align' => 'start',
                            'description' => $profile->description,
                        ])
                    @endforeach
                </div>
            @endif

            @if($companyPage && $companyPage->description)
                <div class="mj-mt-section">
                    @include('web.partials.section-heading', ['title' => $companyPage->name])
                    <div class="mj-content mj-content-wide mj-reveal">{!! $companyPage->description !!}</div>
                </div>
            @endif

            @if($greetingsPage && $greetingsPage->description)
                <div class="mj-mt-section">
                    @include('web.partials.section-heading', ['title' => __('website.founder_message')])
                    <div class="mj-founder-block mj-reveal">
                        @if($greetingsPage->image_url)
                            <figure class="mj-founder-block__image">
                                <img src="{{ $greetingsPage->image_url }}" alt="{{ $greetingsPage->name }}" loading="lazy">
                            </figure>
                        @endif
                        <div>
                            <h3 class="mj-card__title mb-3">{{ $greetingsPage->name }}</h3>
                            <div class="mj-content">{!! $greetingsPage->description !!}</div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- @if($informationBlocks->count())
                <div class="mj-mt-section">
                    @include('web.partials.section-heading', ['title' => __('website.philosophy')])
                    <div class="mj-grid mj-grid--3">
                        @foreach($informationBlocks->take(3) as $block)
                            @include('web.components.info-card', [
                                'title' => $block->name,
                                'icon' => 'bi-stars',
                                'description' => $block->description,
                            ])
                        @endforeach
                    </div>
                </div>
            @endif --}}
        </div>
    </section>

    @include('web.partials.cta-section')
@endsection

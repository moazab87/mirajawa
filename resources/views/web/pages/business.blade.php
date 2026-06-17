@extends('web.layouts.app')

@section('title', ($page?->name ?? __('website.business')) . ' | ' . config('app.name'))
@section('meta_description', Str::limit(strip_tags($page?->description ?? ''), 160))

@section('content')
    @include('web.partials.page-hero', [
        'title' => $page?->name ?? __('website.business'),
        'subtitle' => $page?->sub_title ?? null,
        'breadcrumbs' => [
            __('website.breadcrumb_home') => route('web.home'),
            __('website.business') => route('web.business'),
        ],
    ])

    <section class="mj-section mj-section--white">
        <div class="mj-container">
            @if($page && $page?->description)
                <div class="mj-content mx-auto mb-5" style="max-width:900px;">{!! $page?->description !!}</div>
            @endif

            @if($informationBlocks->count())
                @include('web.partials.section-heading', ['title' => __('website.business_portfolio')])
                <div class="mj-grid mj-grid--3">
                    @foreach($informationBlocks as $block)
                        <div class="mj-info-card">
                            <div class="mj-info-card__icon"><i class="bi bi-briefcase"></i></div>
                            <h3 class="mj-info-card__title">{{ $block->name }}</h3>
                            <div class="mj-content">{!! $block->description !!}</div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- @if($categories->count())
                <div class="mt-5">
                    @include('web.partials.section-heading', ['title' => __('website.products')])
                    <div class="mj-grid mj-grid--3">
                        @foreach($categories as $category)
                            @include('web.components.category-card', ['category' => $category])
                        @endforeach
                    </div>
                </div>
            @endif

            @if($factoryPage && $factoryPage->description)
                <div class="mt-5">
                    @include('web.partials.section-heading', ['title' => $factoryPage->name])
                    <div class="mj-content mx-auto" style="max-width:900px;">{!! $factoryPage->description !!}</div>
                </div>
            @endif

            @php
                $roadmapBlocks = $informationBlocks->slice(-3);
            @endphp
            @if($roadmapBlocks->count() >= 3)
                <div class="mt-5">
                    @include('web.partials.section-heading', ['title' => __('website.roadmap')])
                    <div class="mj-grid mj-grid--3">
                        @foreach([__('website.short_term'), __('website.mid_term'), __('website.long_term')] as $i => $label)
                            @if($roadmap = $roadmapBlocks->values()->get($i))
                                <div class="mj-info-card">
                                    <div class="mj-info-card__icon"><i class="bi bi-signpost-2"></i></div>
                                    <h3 class="mj-info-card__title">{{ $label }}</h3>
                                    <div class="mj-content">{!! $roadmap->description !!}</div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif --}}
        </div>
    </section>

    @include('web.partials.cta-section')
@endsection

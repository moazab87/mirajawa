@extends('web.layouts.app')

@section('title', ($page?->name ?? __('website.company_profile')) . ' | ' . config('app.name'))
@section('meta_description', Str::limit(strip_tags($page?->description ?? ''), 160))

@section('content')
    @include('web.partials.page-hero', [
        'title' => __('website.company_profile'),
        'subtitle' => $page?->sub_title ?? null,
        'breadcrumbs' => [
            __('website.breadcrumb_home') => route('web.home'),
            __('website.company_profile') => route('web.company-profile'),
        ],
    ])

    <section class="mj-section mj-section--white">
        <div class="mj-container">
            @if($page && $page?->description)
                <div class="mj-content mx-auto mb-5" style="max-width:900px;">{!! $page?->description !!}</div>
            @endif

            @if($profiles->count())
                <div class="mj-grid mj-grid--2">
                    @foreach($profiles as $profile)
                        <div class="mj-info-card text-start">
                            <h3 class="mj-info-card__title">{{ $profile->name }}</h3>
                            <div class="mj-content">{!! $profile->description !!}</div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if($greetingsPage && $greetingsPage->description)
                <div class="mt-5 mj-card p-4">
                    @include('web.partials.section-heading', ['title' => __('website.founder_message')])
                    <div class="mj-content">{!! $greetingsPage->description !!}</div>
                </div>
            @endif

            @if($informationBlocks->count())
                <div class="mt-5">
                    <div class="mj-grid mj-grid--3">
                        @foreach($informationBlocks->take(3) as $block)
                            <div class="mj-info-card">
                                <h3 class="mj-info-card__title">{{ $block->name }}</h3>
                                <div class="mj-content">{!! $block->description !!}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    @include('web.partials.cta-section')
@endsection

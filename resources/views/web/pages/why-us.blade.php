@extends('web.layouts.app')

@section('title', ($page?->name ?? __('website.why_mirajawa')) . ' | ' . config('app.name'))
@section('meta_description', Str::limit(strip_tags($page?->description ?? ''), 160))

@section('content')
    @include('web.partials.page-hero', [
        'title' => $page?->name ?? __('website.why_mirajawa'),
        'subtitle' => $page?->sub_title ?? null,
        'breadcrumbs' => [
            __('website.breadcrumb_home') => route('web.home'),
            __('website.why_mirajawa') => route('web.why-us'),
        ],
    ])

    <section class="mj-section mj-section--white">
        <div class="mj-container">
            @if($page && $page?->description)
                <div class="mj-content mj-content-wide mb-5 mj-reveal">{!! $page?->description !!}</div>
            @endif

            @include('web.partials.section-heading', ['title' => __('website.our_strengths')])

            <div class="mj-grid mj-grid--3">
                @forelse($informationBlocks as $block)
                    @include('web.components.info-card', [
                        'title' => $block->name,
                        'icon' => 'bi-award',
                        'description' => $block->description,
                    ])
                @empty
                    @foreach($profiles as $profile)
                        @include('web.components.info-card', [
                            'title' => $profile->name,
                            'icon' => 'bi-check-circle',
                            'description' => $profile->description,
                        ])
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    @include('web.partials.cta-section')
@endsection

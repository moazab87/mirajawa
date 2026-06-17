@extends('web.layouts.app')

@section('title', ($page?->name ?? __('website.history')) . ' | ' . config('app.name'))
@section('meta_description', Str::limit(strip_tags($page?->description ?? ''), 160))

@section('content')
    @include('web.partials.page-hero', [
        'title' => $page?->name ?? __('website.history'),
        'subtitle' => $page?->sub_title ?? null,
        'breadcrumbs' => [
            __('website.breadcrumb_home') => route('web.home'),
            __('website.history') => route('web.history'),
        ],
    ])

    <section class="mj-section mj-section--white">
        <div class="mj-container">
            @if($page && $page?->description)
                <div class="mj-content mj-content-wide mb-5 mj-reveal">{!! $page?->description !!}</div>
            @endif

            @if($histories->count())
                <div class="mj-timeline mx-auto">
                    @foreach($histories as $history)
                        @include('web.components.timeline-item', [
                            'year' => $history->year,
                            'title' => $history->name,
                            'description' => $history->description,
                        ])
                    @endforeach
                </div>
            @else
                @include('web.components.empty-state', [
                    'icon' => 'bi-clock-history',
                    'title' => __('website.no_content'),
                ])
            @endif
        </div>
    </section>

    @include('web.partials.cta-section')
@endsection

@extends('web.layouts.app')

@section('title', __('website.branches') . ' | ' . config('app.name'))

@section('content')
    @include('web.partials.page-hero', [
        'title' => $page?->name ?? __('website.branches'),
        'subtitle' => $page?->sub_title ?? null,
        'breadcrumbs' => [
            __('website.breadcrumb_home') => route('web.home'),
            __('website.branches') => route('web.branches'),
        ],
    ])

    <section class="mj-section mj-section--white">
        <div class="mj-container">
            @if($page && $page?->description)
                <div class="mj-content mx-auto mb-5" style="max-width:900px;">{!! $page?->description !!}</div>
            @endif

            <div class="mj-grid mj-grid--2">
                @forelse($branches as $branch)
                    <div class="mj-card">
                        @if($branch->images->count())
                            <div class="mj-gallery p-3">
                                @foreach($branch->images as $image)
                                    <img src="{{ $image->image_url }}" alt="{{ $branch->name }}" loading="lazy">
                                @endforeach
                            </div>
                        @endif
                        <div class="mj-card__body">
                            <h3 class="mj-card__title">{{ $branch->name }}</h3>
                            <div class="mj-content">{!! $branch->description !!}</div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">{{ __('website.no_content') }}</p>
                @endforelse
            </div>
        </div>
    </section>

    @include('web.partials.cta-section')
@endsection

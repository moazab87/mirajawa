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

            <div class="row g-4">
                @forelse($branches as $branch)
                    <div class="col-md-6">
                        <article class="mj-card h-100">
                            <div class="mj-card__image">
                                @if($branch->images->count())
                                    <img src="{{ $branch->images->first()->image_url }}" alt="{{ $branch->name }}" loading="lazy">
                                @else
                                    <div class="mj-placeholder-image"><i class="bi bi-building" aria-hidden="true"></i></div>
                                @endif
                            </div>
                            <div class="mj-card__body">
                                <h3 class="mj-card__title">{{ $branch->name }}</h3>
                                <div class="mj-content">{!! $branch->description !!}</div>
                            </div>
                            @if($branch->images->count() > 1)
                                <div class="mj-gallery p-3">
                                    @foreach($branch->images->skip(1) as $image)
                                        <img src="{{ $image->image_url }}" alt="{{ $branch->name }}" loading="lazy">
                                    @endforeach
                                </div>
                            @endif
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">{{ __('website.no_content') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @include('web.partials.cta-section')
@endsection

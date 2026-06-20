@extends('web.layouts.app')

@section('title', __('website.videos') . ' | ' . config('app.name'))
@section('meta_description', Str::limit(__('website.videos') . ' — ' . __('website.hero_default_subtitle'), 160))

@section('content')
    @include('web.partials.page-hero', [
        'title' => __('website.videos'),
        'subtitle' => __('website.watch_video'),
        'breadcrumbs' => [
            __('website.breadcrumb_home') => route('web.home'),
            __('website.videos') => route('web.videos.index'),
        ],
    ])

    <section class="mj-section mj-section--beige">
        <div class="mj-container">
            @if($videos->count())
                <div class="mj-videos-list">
                    @foreach($videos as $video)
                        <article @class([
                            'mj-video-card',
                            'mj-reveal',
                            'mj-video-card--reverse' => $loop->odd,
                            'mj-video-card--text-only' => !$video->hasTextContent(),
                        ])>
                            <div class="mj-video-card__content">
                                @if($video->getDisplayTranslation('title'))
                                    <h2 class="mj-video-card__title">{{ $video->title }}</h2>
                                @elseif(!$video->hasTextContent())
                                    <span class="mj-video-card__eyebrow">{{ __('website.mirajawa_video') }}</span>
                                @endif

                                @if($video->getDisplayTranslation('description'))
                                    <div class="mj-content mj-video-card__description">
                                        {!! $video->description !!}
                                    </div>
                                @endif
                            </div>

                            <div class="mj-video-card__media">
                                <video
                                    class="mj-video-card__video js-scroll-video"
                                    muted
                                    playsinline
                                    controls
                                    preload="metadata"
                                    aria-label="{{ $video->getDisplayTranslation('title') ?: __('website.mirajawa_video') }}"
                                >
                                    <source src="{{ $video->video_url }}" type="{{ $video->video_mime }}">
                                    {{ __('dashboard.video_not_supported') }}
                                </video>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="mj-empty-state mj-reveal">
                    <i class="bi bi-camera-video" aria-hidden="true"></i>
                    <p>{{ __('website.no_videos_available') }}</p>
                </div>
            @endif
        </div>
    </section>
@endsection

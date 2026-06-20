@extends('web.layouts.app')

@section('title', __('website.download_company_profile_title') . ' | ' . config('app.name'))
@section('meta_description', Str::limit(__('website.download_company_profile_description'), 160))

@section('content')
    <section class="mj-download-page" aria-label="{{ __('website.download_company_profile_title') }}">
        <div class="mj-download-page__overlay" aria-hidden="true"></div>

        <div class="mj-container mj-download-page__inner">
            @include('web.partials.breadcrumb', [
                'items' => [
                    __('website.breadcrumb_home') => route('web.home'),
                    __('website.company_profile') => route('web.company-profile.download'),
                ],
            ])

            <div class="mj-download-card mj-reveal">
                <span class="mj-download-card__eyebrow">{{ __('website.company_profile') }}</span>
                <h1 class="mj-download-card__title">{{ __('website.download_company_profile_title') }}</h1>
                <p class="mj-download-card__text">{{ __('website.download_company_profile_description') }}</p>

                <dl class="mj-download-card__meta">
                    <div class="mj-download-card__meta-row">
                        <dt>{{ __('website.file_type') }}</dt>
                        <dd>{{ __('website.pptx_file') }}</dd>
                    </div>
                </dl>

                <a
                    href="{{ asset('downloads/mirajawa-company-profile.pptx') }}"
                    download="MIRAJAWA-company-profile.pptx"
                    class="mj-btn mj-btn--gold mj-btn--lg mj-download-card__btn"
                >
                    <i class="bi bi-download" aria-hidden="true"></i>
                    {{ __('website.download_now') }}
                </a>
            </div>
        </div>
    </section>
@endsection

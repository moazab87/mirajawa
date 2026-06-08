@extends('web.layouts.app')

@section('title', __('website.request_information') . ' | ' . config('app.name'))

@section('content')
    @include('web.partials.page-hero', [
        'title' => __('website.request_information'),
        'subtitle' => $page?->sub_title ?? null,
        'breadcrumbs' => [
            __('website.breadcrumb_home') => route('web.home'),
            __('website.request_information') => route('web.request-information.create'),
        ],
    ])

    <section class="mj-section mj-section--white">
        <div class="mj-container">
            @if(session('success'))
                <div class="mj-alert mj-alert--success mj-content-narrow" role="alert">{{ session('success') }}</div>
            @endif

            @if($page && $page?->description)
                <div class="mj-content mj-content-narrow mb-4 mj-reveal">{!! $page?->description !!}</div>
            @endif

            <div class="mj-form-card mj-content-narrow mj-reveal">
                <h2 class="mj-form-card__title">{{ __('website.submit_request') }}</h2>
                <form action="{{ route('web.request-information.store') }}" method="POST" class="mj-form" novalidate>
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">{{ __('website.name') }} <span aria-hidden="true">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">{{ __('website.email') }} <span aria-hidden="true">*</span></label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="company_name" class="form-label">{{ __('website.company_name') }}</label>
                            <input type="text" name="company_name" id="company_name" class="form-control" value="{{ old('company_name') }}" autocomplete="organization">
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">{{ __('website.phone') }}</label>
                            <input type="tel" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" autocomplete="tel">
                        </div>
                        <div class="col-md-8">
                            <label for="address" class="form-label">{{ __('website.address') }}</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" autocomplete="street-address">
                        </div>
                        <div class="col-md-4">
                            <label for="postal_code" class="form-label">{{ __('website.postal_code') }}</label>
                            <input type="text" name="postal_code" id="postal_code" class="form-control" value="{{ old('postal_code') }}" autocomplete="postal-code">
                        </div>
                        <div class="col-12">
                            <label for="message" class="form-label">{{ __('website.message') }}</label>
                            <textarea name="message" id="message" rows="5" class="form-control" placeholder="{{ __('website.request_message_placeholder') }}">{{ old('message') }}</textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="mj-btn mj-btn--primary">
                                <i class="bi bi-file-earmark-arrow-up" aria-hidden="true"></i> {{ __('website.submit_request') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

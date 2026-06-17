@extends('web.layouts.app')

@section('title', __('website.contact_us') . ' | ' . config('app.name'))

@section('content')
    @include('web.partials.page-hero', [
        'title' => $page?->name ?? __('website.contact_us'),
        'subtitle' => $page?->sub_title ?? null,
        'breadcrumbs' => [
            __('website.breadcrumb_home') => route('web.home'),
            __('website.contact_us') => route('web.contact.index'),
        ],
    ])

    <section class="mj-section mj-section--white">
        <div class="mj-container">
            @if(session('success'))
                <div class="mj-alert mj-alert--success" role="alert">{{ session('success') }}</div>
            @endif

            <div class="row g-4 g-lg-5">
                <div class="col-lg-5">
                    <h2 class="mj-contact-sidebar__title mj-reveal">{{ __('website.get_in_touch') }}</h2>

                    @foreach($contactInformation as $info)
                        <div class="mj-contact-card mj-reveal">
                            @if($info->image_url)
                                <img src="{{ $info->image_url }}" alt="{{ $info->name }}" class="mb-3" loading="lazy">
                            @endif
                            <h3 class="mj-contact-card__title">{{ $info->name }}</h3>
                            <div class="mj-content">{!! $info->description !!}</div>
                            @if($info->phone)
                                <p class="mb-0 mt-2"><i class="bi bi-telephone me-2" aria-hidden="true"></i>{{ $info->phone }}</p>
                            @endif
                        </div>
                    @endforeach

                    @if($sitePhone ?? getSettingValue('phone'))
                        <p class="mj-reveal"><i class="bi bi-telephone me-2" aria-hidden="true"></i>{{ $sitePhone ?? getSettingValue('phone') }}</p>
                    @endif

                    @foreach($addresses as $address)
                        <div class="mj-contact-card mj-reveal">
                            <h3 class="mj-contact-card__title">{{ $address->name }}</h3>
                            <div class="mj-content">{!! $address->description !!}</div>
                            @if($address->address)
                                <p class="mb-1 mt-2"><i class="bi bi-geo-alt me-2" aria-hidden="true"></i>{{ $address->address }}</p>
                            @endif
                            @if($address->map_desc)
                                <p class="text-muted small mb-0">{!! $address->map_desc !!}</p>
                            @endif
                            {{-- @if($address->lat && $address->lng)
                                <a href="https://maps.google.com/?q={{ $address->lat }},{{ $address->lng }}" target="_blank" rel="noopener noreferrer" class="mj-btn mj-btn--outline mj-btn--sm mt-3">
                                    <i class="bi bi-map" aria-hidden="true"></i> {{ __('website.map') }}
                                </a>
                            @endif --}}
                        </div>
                    @endforeach
                </div>

                <div class="col-lg-7">
                    <div class="mj-form-card mj-reveal">
                        <h2 class="mj-form-card__title">{{ __('website.send_message') }}</h2>
                        <form action="{{ route('web.contact.store') }}" method="POST" class="mj-form" novalidate>
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
                                <div class="col-12">
                                    <label for="message" class="form-label">{{ __('website.message') }} <span aria-hidden="true">*</span></label>
                                    <textarea name="message" id="message" rows="5" class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="mj-btn mj-btn--primary">
                                        <i class="bi bi-send" aria-hidden="true"></i> {{ __('website.send_message') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if($faqs->count())
                <div class="mj-mt-section">
                    @include('web.partials.section-heading', ['title' => __('website.faqs')])
                    <div class="mj-accordion accordion mj-content-narrow" id="faqAccordion">
                        @foreach($faqs as $faq)
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ $faq->question }}
                                    </button>
                                </h3>
                                <div id="faq{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body mj-content">{!! $faq->answer !!}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

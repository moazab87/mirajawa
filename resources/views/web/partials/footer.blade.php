<footer class="mj-footer">
    <div class="mj-container">
        <div class="row g-4 g-lg-5">
            <div class="col-lg-4">
                <div class="mj-footer__brand-row">
                    <a href="{{ route('web.home') }}" class="mj-footer__logo-link">
                        <img src="{{ getSettingImageLink('logo', true) ?: getSettingImageLink('logo') }}"
                             alt="{{ config('app.name') }}" class="mj-footer__logo" width="160" height="42" loading="lazy">
                    </a>
                    @if($siteSinceYear ?? getSettingValue('since_year'))
                        <span class="mj-since-badge">
                            <i class="bi bi-calendar3" aria-hidden="true"></i>
                            {{ __('website.since') }} {{ $siteSinceYear ?? getSettingValue('since_year') }}
                        </span>
                    @endif
                </div>
                <p class="mj-footer__brand-text mb-0">{{ __('website.hero_default_subtitle') }}</p>
            </div>

            <div class="col-6 col-lg-2">
                <h2 class="mj-footer__title">{{ __('website.quick_links') }}</h2>
                <nav aria-label="{{ __('website.quick_links') }}">
                    <a href="{{ route('web.about') }}">{{ __('website.about_us') }}</a>
                    {{-- <a href="{{ route('web.company-profile') }}">{{ __('website.company_profile') }}</a> --}}
                    <a href="{{ route('web.business') }}">{{ __('website.business') }}</a>
                    <a href="{{ route('web.history') }}">{{ __('website.history') }}</a>
                    <a href="{{ route('web.privacy') }}">{{ __('website.privacy_policy') }}</a>
                </nav>
            </div>

            <div class="col-6 col-lg-3">
                <h2 class="mj-footer__title">{{ __('website.products') }}</h2>
                <nav aria-label="{{ __('website.products') }}">
                    @forelse(($navCategories ?? collect())->take(6) as $category)
                        <a href="{{ route('web.products.index', ['category' => $category->id]) }}">{{ $category->name }}</a>
                    @empty
                        <a href="{{ route('web.products.index') }}">{{ __('website.view_products') }}</a>
                    @endforelse
                </nav>
            </div>

            <div class="col-lg-3">
                <h2 class="mj-footer__title">{{ __('website.contact_us') }}</h2>
                @if($sitePhone ?? getSettingValue('phone'))
                    <p class="mb-2"><i class="bi bi-telephone me-2" aria-hidden="true"></i>{{ $sitePhone ?? getSettingValue('phone') }}</p>
                @endif
                <a href="{{ route('web.request-information.create') }}">{{ __('website.request_information') }}</a>
                <a href="{{ route('web.contact.index') }}">{{ __('website.get_in_touch') }}</a>

                @php $activeSocials = ($socials ?? collect())->filter(fn ($s) => filled($s->url)); @endphp
                @if($activeSocials->count())
                    <div class="mj-social mt-3 d-flex flex-row flex-wrap align-items-center" aria-label="{{ __('website.follow_us') }}">
                        @foreach($activeSocials as $social)
                            <a href="{{ $social->url }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="mj-social__link"
                               title="{{ $social->name }}"
                               aria-label="{{ __('website.open_social_link', ['name' => $social->name]) }}">
                                <i class="{{ filled($social->icon) ? $social->icon : 'bi bi-globe' }}" aria-hidden="true"></i>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="mj-footer__bottom">
            © {{ date('Y') }} {{ config('app.name') }}. {{ __('website.all_rights_reserved') }}
        </div>
    </div>
</footer>

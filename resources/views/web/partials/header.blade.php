<header class="mj-header">
    <div class="mj-container mj-header__inner">
        <a class="mj-logo" href="{{ route('web.home') }}" aria-label="{{ __('website.breadcrumb_home') }} — {{ config('app.name') }}">
            <img src="{{ getSettingImageLink('logo', true) ?: getSettingImageLink('logo') }}"
                 alt="{{ config('app.name') }}" width="160" height="44" loading="eager">
        </a>

        <div class="mj-header__nav-group">
            <nav class="mj-nav-wrap" id="site-nav" aria-label="{{ __('website.main_navigation') }}">
                <div class="mj-nav-wrap__head">
                    <span class="mj-nav-wrap__brand">{{ config('app.name') }}</span>
                    <button class="mj-menu-close" type="button" aria-label="{{ __('website.close_menu') }}">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <ul class="mj-nav">
                    <li><a href="{{ route('web.home') }}" class="{{ isCurrentRoute('web.home') ? 'active' : '' }}">{{ __('website.home') }}</a></li>
                    <li><a href="{{ route('web.about') }}" class="{{ isCurrentRoute('web.about') ? 'active' : '' }}">{{ __('website.about_us') }}</a></li>
                    <li><a href="{{ route('web.business') }}" class="{{ isCurrentRoute('web.business') ? 'active' : '' }}">{{ __('website.business') }}</a></li>
                    <li><a href="{{ route('web.products.index') }}" class="{{ request()->routeIs('web.products.*') ? 'active' : '' }}">{{ __('website.products') }}</a></li>
                    {{-- <li><a href="{{ route('web.why-us') }}" class="{{ isCurrentRoute('web.why-us') ? 'active' : '' }}">{{ __('website.why_mirajawa') }}</a></li> --}}
                    <li><a href="{{ route('web.history') }}" class="{{ isCurrentRoute('web.history') ? 'active' : '' }}">{{ __('website.history') }}</a></li>
                    <li><a href="{{ route('web.contact.index') }}" class="{{ isCurrentRoute('web.contact.*') ? 'active' : '' }}">{{ __('website.contact_us') }}</a></li>
                </ul>

                <div class="mj-header__actions mj-header__actions--mobile">
                    <div class="dropdown">
                        <button class="mj-lang dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="fi fi-{{ trans('route.langFlag') }} fis me-1"></span>
                            {{ getLanguageName(app()->getLocale()) }}
                        </button>
                        <ul class="dropdown-menu w-100">
                            @foreach(['en', 'ja', 'ar'] as $lang)
                                @if($lang !== app()->getLocale())
                                    <li>
                                        <a class="dropdown-item" href="{{ route('web.change.language', $lang) }}">
                                            <span class="fi fi-{{ getLanguageFlag($lang) }} fis me-2"></span>
                                            {{ getLanguageName($lang) }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <a href="{{ route('web.contact.index') }}" class="mj-btn mj-btn--outline w-100">{{ __('website.contact_us') }}</a>
                    <a href="{{ route('web.request-information.create') }}" class="mj-btn mj-btn--primary w-100">
                        <i class="bi bi-file-earmark-text"></i> {{ __('website.request_information') }}
                    </a>
                </div>
            </nav>

            <div class="mj-header__actions">
                <div class="dropdown">
                    <button class="mj-lang dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fi fi-{{ trans('route.langFlag') }} fis me-1"></span>
                        {{ getLanguageName(app()->getLocale()) }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @foreach(['en', 'ja', 'ar'] as $lang)
                            @if($lang !== app()->getLocale())
                                <li>
                                    <a class="dropdown-item" href="{{ route('web.change.language', $lang) }}">
                                        <span class="fi fi-{{ getLanguageFlag($lang) }} fis me-2"></span>
                                        {{ getLanguageName($lang) }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <a href="{{ route('web.contact.index') }}" class="mj-btn mj-btn--outline mj-btn--sm">{{ __('website.contact_us') }}</a>
                <a href="{{ route('web.request-information.create') }}" class="mj-btn mj-btn--primary mj-btn--sm">
                    {{ __('website.request_information') }}
                </a>
            </div>
        </div>

        <button class="mj-menu-toggle" type="button" aria-label="{{ __('website.open_menu') }}" aria-expanded="false" aria-controls="site-nav">
            <i class="bi bi-list"></i>
        </button>
    </div>
    <div class="mj-overlay" aria-hidden="true"></div>
</header>

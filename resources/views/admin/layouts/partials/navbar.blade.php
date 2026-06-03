<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="container-fluid">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)" aria-label="Menu">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center flex-grow-1 justify-content-end" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center gap-1">
                <li class="nav-item dropdown-language dropdown">
                    <a class="nav-link hide-arrow d-flex align-items-center dropdown-toggle"
                        href="javascript:void(0);"
                        data-bs-toggle="dropdown"
                        title="{{ __('admin.change_language') }}"
                        aria-label="{{ __('admin.change_language') }}">
                        <i class="fi fi-{{ trans('route.langFlag') }} fis rounded-circle fs-4"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @foreach(['en', 'ja', 'ar'] as $lang)
                            @if($lang !== app()->getLocale())
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('web.change.language', $lang) }}">
                                        <i class="fi fi-{{ getLanguageFlag($lang) }} fis me-2"></i>
                                        <span>{{ getLanguageName($lang) }}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>

                @include('admin.layouts.partials.profile')
            </ul>
        </div>
    </div>
</nav>

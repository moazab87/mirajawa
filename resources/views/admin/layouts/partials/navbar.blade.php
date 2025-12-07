<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme mx-4" id="layout-navbar">
    <div class="container-fluid">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Language Toggle -->
                <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                    <a class="nav-link hide-arrow d-flex align-items-center"
                        href="{{ route('web.change.language', trans('route.otherLang')) }}"
                        id="languageToggle"
                        title="{{ __('admin.change_language') }}"
                        aria-label="{{ __('admin.change_language') }}"
                        style="min-width: 40px; min-height: 40px;">
                        <i class="fi fi-{{ trans('route.langFlag') }} fis rounded-circle fs-3 toggleLang" style="display: inline-block;"></i>
                    </a>
                </li>
                <!--/ Language Toggle -->


                <!-- Style Switcher -->
                <li class="nav-item me-2 me-xl-0">
                    <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                        <i class="bx bx-sm"></i>
                    </a>
                </li>
                <!--/ Style Switcher -->
                <!-- Notification -->
                {{-- <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
                    <a class="nav-link dropdown-toggle hide-arrow" href="{{ route('admin.notifications.index') }}"
                        id="notificationsDropdown" data-bs-auto-close="outside" aria-expanded="false">
                        <i class="bx bx-bell bx-sm"></i>
                        @if (auth()->user()->unreadNotifications->count() > 0)
                            <span class="badge bg-danger rounded-pill badge-notifications">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </a>
                </li> --}}

                <!-- User -->
                @include('admin.layouts.partials.profile')
                <!--/ User -->
            </ul>
        </div>

        <!-- Search Small Screens -->
        <div class="navbar-search-wrapper search-input-wrapper d-none">
            <input type="text" class="form-control search-input container-fluid border-0" placeholder="Search..."
                aria-label="Search..." />
            <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
        </div>
    </div>
</nav>

<script>
    $(document).ready(function() {
        $('#languageToggle').on('click', function() {
            alert('Language toggle clicked! Current language: ' + '{{ app()->getLocale() }}');
        });
    })
</script>

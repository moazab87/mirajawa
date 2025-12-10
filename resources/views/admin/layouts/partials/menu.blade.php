<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo d-flex justify-content-center align-items-center mt-2">
        <a href="{{ route('admin.admin.index') }}" class="app-brand-link mt-4 w-100">
            <img src="{{ getSettingImageLink('logo', true) }}" alt="Logo" class="img-fluid rounded"
                style="object-fit: contain; width: 100%; height: 120px; margin: 0 auto;">
        </a>
    </div>

    <div class="menu-divider mt-0"></div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">

        <!-- Dashboard -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">@lang('route.dashboard')</span>
        </li>
        {{-- @can('admin.index') --}}
        {{-- <li class="menu-item {{ isset($active) && $active == 'tasks' ? 'active' : '' }}">
            <a href="{{ route('admin.tasks.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-task"></i>
                <div>@lang('route.tasks.index')</div>
            </a>
        </li> --}}
        <li class="menu-item {{ isset($active) && $active == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.admin.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home"></i>
                    <div data-i18n="@lang('route.dashboard')">@lang('route.dashboard')</div>
                </a>
            </li>
            <li class="menu-item {{ isset($active) && $active == 'sliders' ? 'active' : '' }}">
                <a href="{{ route('admin.sliders.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-image"></i>
                    <div data-i18n="@lang('route.sliders.index')">@lang('route.sliders.index')</div>
                </a>
            </li>
        {{-- @endcan --}}
        <!-- Users Management -->
        {{-- <li class="menu-item {{ isset($active) && in_array($active, ['admins', 'users', 'roles']) ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div>@lang('admin.users_management')</div>
            </a>
            <ul class="menu-sub">
                <!-- Admins -->
                @can('admins.index')
                    <li class="menu-item {{ isset($active) && $active == 'admins' ? 'active' : '' }}">
                        <a href="{{ route('admin.admins.index') }}" class="menu-link">
                            <div>@lang('route.admins.index')</div>
                        </a>
                    </li>
                @endcan
                <!-- Users -->
                @can('users.index')
                    <li class="menu-item {{ isset($active) && $active == 'users' ? 'active' : '' }}">
                        <a href={{ route('admin.users.index') }} class="menu-link">
                            <div>@lang('route.users.index')</div>
                        </a>
                    </li>
                @endcan
                <!-- Roles List -->
                @can('roles.index')
                    <li class="menu-item {{ isset($active) && $active == 'roles' ? 'active' : '' }}">
                        <a href="{{ route('admin.roles.index') }}" class="menu-link">
                            <div>@lang('route.roles.index')</div>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>

        <!-- clients Management -->
        <li class="menu-item {{ isset($active) && in_array($active, ['clients', 'projects']) ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-briefcase"></i>
                <div>@lang('admin.clients_management')</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ isset($active) && $active == 'clients' ? 'active' : '' }}">
                    <a href="{{ route('admin.clients.index') }}" class="menu-link">
                        <div>@lang('route.clients.index')</div>
                    </a>
                </li>
                <li class="menu-item {{ isset($active) && $active == 'projects' ? 'active' : '' }}">
                    <a href="{{ route('admin.projects.index') }}" class="menu-link">
                        <div>@lang('route.projects.index')</div>
                    </a>
                </li>
            </ul>
        </li> --}}



        <!-- teams -->
        {{-- @can('teams.index') --}}
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">@lang('route.categories.index')</span>
        </li>
        <li class="menu-item {{ isset($active) && $active == 'categories' ? 'active' : '' }}">
            <a href="{{ route('admin.categories.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div>@lang('route.categories.index')</div>
            </a>
        </li>
        {{-- @endcan --}}
        <li class="menu-item {{ isset($active) && $active == 'products' ? 'active' : '' }}">
            <a href="{{ route('admin.products.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div>@lang('route.products.index')</div>
            </a>
        </li>

        <!-- Settings -->
        {{-- @can('settings.index') --}}
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">@lang('route.general_settings')</span>
            </li>
            <li class="menu-item {{ isset($active) && $active == 'settings' ? 'active' : '' }}">
                <a href="{{ route('admin.settings.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-cog"></i>
                    <div>@lang('route.settings')</div>
                </a>
            </li>
        <li class="menu-item {{ isset($active) && $active == 'fixedPages' ? 'active' : '' }}">
            <a href="{{ route('admin.fixedPages.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div>@lang('route.fixedPages.index')</div>
            </a>
        </li>
        {{-- @endcan --}}

    </ul>
</aside>
<!-- / Menu -->

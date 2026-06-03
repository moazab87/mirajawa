<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo d-flex justify-content-center align-items-center">
        <a href="{{ route('admin.admin.index') }}" class="app-brand-link w-100 text-center py-3">
            <img src="{{ getSettingImageLink('logo', true) }}" alt="Logo" class="img-fluid"
                style="object-fit: contain; max-height: 72px; width: auto; margin: 0 auto;">
        </a>
    </div>

    <div class="menu-divider mt-0"></div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-2">

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">@lang('dashboard.dashboard')</span>
        </li>
        <li class="menu-item {{ isset($active) && $active == 'dashboard' ? 'active' : '' }}">
            <a href="{{ route('admin.admin.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home"></i>
                <div>@lang('dashboard.dashboard')</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">@lang('dashboard.menu.website_content')</span>
        </li>
        <li class="menu-item {{ isset($active) && $active == 'settings' ? 'active' : '' }}">
            <a href="{{ route('admin.settings.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div>@lang('dashboard.settings.index')</div>
            </a>
        </li>
        <li class="menu-item {{ isset($active) && $active == 'fixedPages' ? 'active' : '' }}">
            <a href="{{ route('admin.fixedPages.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div>@lang('dashboard.static_pages.index')</div>
            </a>
        </li>
        <li class="menu-item {{ isset($active) && $active == 'sliders' ? 'active' : '' }}">
            <a href="{{ route('admin.sliders.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-image"></i>
                <div>@lang('dashboard.sliders.index')</div>
            </a>
        </li>
        <li class="menu-item {{ isset($active) && $active == 'profiles' ? 'active' : '' }}">
            <a href="{{ route('admin.profiles.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-id-card"></i>
                <div>@lang('dashboard.profiles.index')</div>
            </a>
        </li>
        <li class="menu-item {{ isset($active) && $active == 'histories' ? 'active' : '' }}">
            <a href="{{ route('admin.histories.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-time-five"></i>
                <div>@lang('dashboard.histories.index')</div>
            </a>
        </li>
        <li class="menu-item {{ isset($active) && $active == 'informationBlocks' ? 'active' : '' }}">
            <a href="{{ route('admin.informationBlocks.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-info-circle"></i>
                <div>@lang('dashboard.information.index')</div>
            </a>
        </li>
        <li class="menu-item {{ isset($active) && $active == 'contactInformation' ? 'active' : '' }}">
            <a href="{{ route('admin.contactInformation.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-phone"></i>
                <div>@lang('dashboard.contact_information.index')</div>
            </a>
        </li>
        <li class="menu-item {{ isset($active) && $active == 'faqs' ? 'active' : '' }}">
            <a href="{{ route('admin.faqs.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-help-circle"></i>
                <div>@lang('dashboard.faqs.index')</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">@lang('dashboard.menu.products_section')</span>
        </li>
        <li class="menu-item {{ isset($active) && $active == 'categories' ? 'active' : '' }}">
            <a href="{{ route('admin.categories.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div>@lang('dashboard.categories.index')</div>
            </a>
        </li>
        <li class="menu-item {{ isset($active) && $active == 'productGroups' ? 'active' : '' }}">
            <a href="{{ route('admin.productGroups.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-layer"></i>
                <div>@lang('dashboard.product_groups.index')</div>
            </a>
        </li>
        <li class="menu-item {{ isset($active) && $active == 'products' ? 'active' : '' }}">
            <a href="{{ route('admin.products.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div>@lang('dashboard.products.index')</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">@lang('dashboard.menu.contact_requests')</span>
        </li>
        <li class="menu-item {{ isset($active) && $active == 'contactMessages' ? 'active' : '' }}">
            <a href="{{ route('admin.contactMessages.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-mail-send"></i>
                <div>@lang('dashboard.contact_messages.index')</div>
            </a>
        </li>
        <li class="menu-item {{ isset($active) && $active == 'informationRequests' ? 'active' : '' }}">
            <a href="{{ route('admin.informationRequests.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file-find"></i>
                <div>@lang('dashboard.information_requests.index')</div>
            </a>
        </li>
        <li class="menu-item {{ isset($active) && $active == 'addresses' ? 'active' : '' }}">
            <a href="{{ route('admin.addresses.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-map"></i>
                <div>@lang('dashboard.addresses.index')</div>
            </a>
        </li>
        <li class="menu-item {{ isset($active) && $active == 'branches' ? 'active' : '' }}">
            <a href="{{ route('admin.branches.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-buildings"></i>
                <div>@lang('dashboard.branches.index')</div>
            </a>
        </li>
        <li class="menu-item {{ isset($active) && $active == 'socials' ? 'active' : '' }}">
            <a href="{{ route('admin.socials.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-globe"></i>
                <div>@lang('dashboard.socials.index')</div>
            </a>
        </li>

    </ul>
</aside>

<li class="nav-item navbar-dropdown dropdown-user dropdown">
    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
                <img src="{{ auth()->user()->image }}" alt="User Avatar" class="rounded-circle">
        </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                            <img src="{{ auth()->user()->image }}" alt="User Avatar" class="rounded-circle">
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        @auth
                            <span class="fw-semibold d-block lh-1">{{ auth()->user()->name }}</span>
                            <small>{{ auth()->user()->phone }}</small>
                        @endauth
                    </div>
                </div>
            </a>
        </li>
        <li>
            <div class="dropdown-divider"></div>
        </li>
        <li>
            <button class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bx {{ Auth::check() ? 'bx-power-off' : 'bx-log-in' }} me-2"></i>
                <span class="align-middle">{{ Auth::check() ?
                    __('admin.logout') : __('admin.login')
                 }}</span>
            </button>
        </li>

        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </ul>
</li>

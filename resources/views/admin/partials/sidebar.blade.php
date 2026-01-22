@php
    // Simple active helpers
    function is_active_route($name)
    {
        return request()->routeIs($name) ? 'active' : '';
    }

    function is_active_prefix($prefix)
    {
        return request()->routeIs($prefix . '.*') ? 'show' : '';
    }

    function is_active_parent($prefix)
    {
        return request()->routeIs($prefix . '.*') ? '' : 'collapsed';
    }
@endphp


<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('admin.dashboard') }}" target="_blank">
            <img src="../assets/img/logo-ct-dark.png" width="26px" height="26px" class="navbar-brand-img h-100"
                alt="main_logo">
            <span class="ms-1 font-weight-bold">{{ config('app.name', 'Admin Panel') }}</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ is_active_route('admin.dashboard') }}" href="{{ route('admin.dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            @canany(['users view', 'roles view', 'permissions view'])
                <!-- User Management Dropdown -->
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">User Management</h6>
                </li>
            @endcanany
            <!-- Users -->
            @can('users view')
                <li class="nav-item">
                    <a class="nav-link {{ is_active_route('admin.users.index') }}" href="{{ route('admin.users.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Users</span>
                    </a>
                </li>
            @endcan
            @can('roles view')
                <li class="nav-item">
                    <a class="nav-link {{ is_active_route('admin.roles.index') }}" href="{{ route('admin.roles.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-badge text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Roles</span>
                    </a>
                </li>
            @endcan

            @can('permissions view')
                <li class="nav-item">
                    <a class="nav-link {{ is_active_route('admin.permissions.index') }}"
                        href="{{ route('admin.permissions.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-key-25 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Permissions</span>
                    </a>
                </li>
            @endcan

            <!-- Judges Management -->
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Judges Management</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ is_active_route('admin.judges.index') }}"
                    href="{{ route('admin.judges.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Judges</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ is_active_route('admin.judge-tags.index') }}"
                    href="{{ route('admin.judge-tags.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tag text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Judge Tags</span>
                </a>
            </li>

            <!-- Products Management -->
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Products Management</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ is_active_route('admin.artists-products.index') }}"
                    href="{{ route('admin.artists-products.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-box-2 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Artists Products</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ is_active_route('admin.artists-categories.index') }}"
                    href="{{ route('admin.artists-categories.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-collection text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Product Categories</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ is_active_route('admin.artists.index') }}"
                    href="{{ route('admin.artists.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Artists</span>
                </a>
            </li>

            <!-- Product Attributes -->
            <li class="nav-item">
                <a class="nav-link {{ is_active_route('admin.colors.index') }}"
                    href="{{ route('admin.colors.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-palette text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Colors</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ is_active_route('admin.sizes.index') }}"
                    href="{{ route('admin.sizes.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-ruler-pencil text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sizes</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ is_active_route('admin.product-reviews.index') }}"
                    href="{{ route('admin.product-reviews.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-favourite-28 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Product Reviews</span>
                </a>
            </li>

            <!-- Original Menu Items (Optional - Keep or Remove) -->
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">General Setting</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ is_active_route('admin.settings.edit') }}"
                    href="{{ route('admin.settings.edit') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-settings-gear-65 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">General Setting</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ is_active_route('admin.media.*') }}" href="{{ route('admin.media.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-image text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Media</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ is_active_route('admin.hero.edit') }}" href="{{ route('admin.hero.edit') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-image text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Hero Section</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ is_active_route('admin.how.index') }}" href="{{ route('admin.how.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bulb-61 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">How It Works</span>
                </a>
            </li>


            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Original Pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="../pages/tables.html">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Tables</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="../pages/billing.html">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-credit-card text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Billing</span>
                </a>
            </li>

            <!-- Account pages -->
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="../pages/profile.html">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="../pages/sign-in.html">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sign In</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="../pages/sign-up.html">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-collection text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sign Up</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

@push('styles')
    <style>
        .nav-link.collapsed .fa-chevron-down {
            transform: rotate(-90deg);
            transition: transform 0.3s ease;
        }

        .nav-link:not(.collapsed) .fa-chevron-down {
            transform: rotate(0deg);
            transition: transform 0.3s ease;
        }

        .sidenav-mini-icon {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            color: #6c757d;
            min-width: 20px;
            display: inline-block;
        }

        .sidenav-normal {
            margin-left: 8px;
            font-size: 0.875rem;
        }

        .nav.ms-4 {
            margin-left: 1.5rem !important;
        }

        .nav.ms-4 .nav-item {
            margin-bottom: 0.25rem;
        }

        .nav.ms-4 .nav-link {
            padding: 0.25rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
        }

        .nav.ms-4 .nav-link:hover {
            background-color: #f8f9fa;
        }

        .nav.ms-4 .nav-link.active {
            background-color: #5e72e4;
            color: white !important;
        }

        .nav.ms-4 .nav-link.active .sidenav-mini-icon {
            color: white !important;
        }
    </style>
@endpush

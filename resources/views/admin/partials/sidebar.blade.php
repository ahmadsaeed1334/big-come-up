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

{{-- <style>
    .app-sidebar {
        width: 260px;
        min-height: 100vh;
        background: #0f172a;
        /* slate-ish */
        color: #fff;
        position: sticky;
        top: 0;
    }

    .app-sidebar .brand {
        font-weight: 700;
        letter-spacing: .5px;
    }

    .app-sidebar .nav-link {
        color: rgba(255, 255, 255, .85);
        border-radius: 8px;
        padding: .55rem .75rem;
    }

    .app-sidebar .nav-link:hover {
        background: rgba(255, 255, 255, .08);
        color: #fff;
    }

    .app-sidebar .nav-link.active {
        background: rgba(255, 255, 255, .16);
        color: #fff;
        font-weight: 600;
    }

    .app-sidebar .section-title {
        font-size: .72rem;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: rgba(255, 255, 255, .55);
        margin: 1.2rem 0 .5rem;
        padding: 0 .25rem;
    }

    .app-sidebar .collapse .nav-link {
        padding-left: 1.6rem;
        font-size: .95rem;
    }

    .sidebar-divider {
        border-top: 1px solid rgba(255, 255, 255, .08);
        margin: .75rem 0;
    }
</style> --}}

{{-- <aside class="app-sidebar p-3"> --}}
{{-- Brand --}}
{{-- <div class="d-flex align-items-center gap-2 mb-3">
        <div class="bg-white text-dark rounded-circle d-flex align-items-center justify-content-center"
            style="width:34px;height:34px;font-weight:700;">
            TB
        </div>
        <div>
            <div class="brand">The Big Come Up</div>
            <div class="small text-white-50">Admin Panel</div>
        </div>
    </div>

    <div class="sidebar-divider"></div> --}}

{{-- Common/User --}}
{{-- <div class="section-title">General</div>
    <ul class="nav nav-pills flex-column gap-1">
        <li class="nav-item">
            <a class="nav-link {{ is_active_route('dashboard') }}" href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ is_active_route('home') }}" href="{{ route('home') }}">
                <i class="bi bi-house-door me-2"></i> Home
            </a>
        </li>
    </ul>

    <div class="sidebar-divider"></div> --}}

{{-- ADMIN SECTION --}}
{{-- <div class="section-title">Admin</div>

    <ul class="nav nav-pills flex-column gap-1"> --}}

{{-- Access Control --}}
{{-- <li class="nav-item">
            <a class="nav-link {{ is_active_parent('admin.permissions') }} {{ is_active_parent('admin.roles') }}"
                data-bs-toggle="collapse" href="#collapseAccessControl" role="button"
                aria-expanded="{{ request()->routeIs('admin.permissions.*') || request()->routeIs('admin.roles.*') ? 'true' : 'false' }}"
                aria-controls="collapseAccessControl">
                <i class="bi bi-shield-lock me-2"></i> Access Control
            </a>
            <div class="collapse {{ request()->routeIs('admin.permissions.*') || request()->routeIs('admin.roles.*') ? 'show' : '' }}"
                id="collapseAccessControl">
                <ul class="nav flex-column mt-1">
                    <li class="nav-item">
                        <a class="nav-link {{ is_active_route('admin.permissions.index') }}"
                            href="{{ route('admin.permissions.index') }}">
                            Permissions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ is_active_route('admin.roles.index') }}"
                            href="{{ route('admin.roles.index') }}">
                            Roles
                        </a>
                    </li>
                </ul>
            </div>
        </li> --}}


{{-- <li class="nav-item">
            <a class="nav-link
        {{ request()->routeIs('admin.artists.*') ||
        request()->routeIs('admin.artists-products.*') ||
        request()->routeIs('admin.artists-categories.*')
            ? 'active'
            : '' }}"
                data-bs-toggle="collapse" data-bs-target="#collapseArtists" role="button">

                <i class="bi bi-palette me-2"></i> Artists
            </a>

            <div class="collapse
        {{ request()->routeIs('admin.artists.*') ||
        request()->routeIs('admin.artists-products.*') ||
        request()->routeIs('admin.artists-categories.*')
            ? 'show'
            : '' }}"
                id="collapseArtists">

                <ul class="nav flex-column mt-1">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.artists.index') ? 'active' : '' }}"
                            href="{{ route('admin.artists.index') }}">
                            All Artists
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.artists-categories.*') ? 'active' : '' }}"
                            href="{{ route('admin.artists-categories.index') }}">
                            Artist Categories
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.artists-products.*') ? 'active' : '' }}"
                            href="{{ route('admin.artists-products.index') }}">
                            Artist Products
                        </a>
                    </li>

                </ul>
            </div>
        </li> --}}



{{-- Competitions Module --}}
{{-- 
        <li class="nav-item">
            <a class="nav-link {{ is_active_parent('admin.competitions') }}" data-bs-toggle="collapse"
                data-bs-target="#collapseCompetitions" role="button" aria-expanded="false"
                aria-controls="collapseCompetitions">
                <i class="bi bi-trophy me-2"></i> Competitions
            </a>

            <div class="collapse {{ is_active_prefix('admin.competitions') }}" id="collapseCompetitions">
                <ul class="nav flex-column mt-1">
                    <li class="nav-item">
                        <a class="nav-link {{ is_active_route('admin.competitions.index') }}"
                            href="{{ route('admin.competitions.index') }}">
                            All Competitions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.competitions.create') }}">
                            Create Competition
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ is_active_parent('admin.judges') }}" data-bs-toggle="collapse"
                data-bs-target="#collapseJudges" role="button" aria-expanded="false" aria-controls="collapseJudges">
                <i class="bi bi-person-badge me-2"></i> Judges
            </a>

            <div class="collapse {{ is_active_prefix('admin.judges') }}" id="collapseJudges">
                <ul class="nav flex-column mt-1">
                    <li class="nav-item">
                        <a class="nav-link {{ is_active_route('admin.judges.index') }}"
                            href="{{ route('admin.judges.index') }}">
                            All Judges
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ is_active_route('admin.judge-tags.index') }}"
                            href="{{ route('admin.judge-tags.index') }}">
                            Judge Tags
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ is_active_route('admin.judges.create') }}"
                            href="{{ route('admin.judges.create') }}">
                            Create Judge
                        </a>
                    </li>
                </ul>
            </div>
        </li> --}}

{{-- Entries --}}
{{-- <li class="nav-item">
            <a class="nav-link {{ is_active_parent('admin.entries') }}" data-bs-toggle="collapse"
                href="#collapseEntries" role="button">
                <i class="bi bi-collection-play me-2"></i> Entries
            </a>
            <div class="collapse {{ is_active_prefix('admin.entries') }}" id="collapseEntries">
                <ul class="nav flex-column mt-1">
                    <li class="nav-item">
                        <a class="nav-link {{ is_active_route('admin.entries.index') }}"
                            href="{{ route('admin.entries.index') }}">
                            All Entries
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.entries.create') }}">
                            Create Entry
                        </a>
                    </li>
                </ul>
            </div>
        </li> --}}

{{-- Votes --}}
{{-- <li class="nav-item">
            <a class="nav-link {{ is_active_route('admin.votes.index') }}" href="{{ route('admin.votes.index') }}">
                <i class="bi bi-hand-thumbs-up me-2"></i> Votes
            </a>
        </li> --}}

{{-- Winner Payouts --}}
{{-- <li class="nav-item">
            <a class="nav-link {{ is_active_parent('admin.winner-payouts') }}" data-bs-toggle="collapse"
                href="#collapseWinners" role="button">
                <i class="bi bi-cash-coin me-2"></i> Winner Payouts
            </a>
            <div class="collapse {{ is_active_prefix('admin.winner-payouts') }}" id="collapseWinners">
                <ul class="nav flex-column mt-1">
                    <li class="nav-item">
                        <a class="nav-link {{ is_active_route('admin.winner-payouts.index') }}"
                            href="{{ route('admin.winner-payouts.index') }}">
                            All Payouts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.winner-payouts.create') }}">
                            Add Payout
                        </a>
                    </li>
                </ul>
            </div>
        </li> --}}

{{-- Reports --}}
{{-- <li class="nav-item">
            <a class="nav-link {{ is_active_parent('admin.reports') }}" data-bs-toggle="collapse"
                href="#collapseReports" role="button">
                <i class="bi bi-flag me-2"></i> Reports
            </a>
            <div class="collapse {{ is_active_prefix('admin.reports') }}" id="collapseReports">
                <ul class="nav flex-column mt-1">
                    <li class="nav-item">
                        <a class="nav-link {{ is_active_route('admin.reports.index') }}"
                            href="{{ route('admin.reports.index') }}">
                            All Reports
                        </a>
                    </li>
                </ul>
            </div>
        </li> --}}

{{-- Ecommerce --}}
{{-- <li class="nav-item">
            <a class="nav-link {{ is_active_parent('admin.categories') }} {{ is_active_parent('admin.products') }} {{ is_active_parent('admin.orders') }} {{ is_active_parent('admin.payments') }} {{ is_active_parent('admin.coupons') }}"
                data-bs-toggle="collapse" href="#collapseEcommerce" role="button"
                aria-expanded="{{ request()->routeIs('admin.categories.*', 'admin.products.*', 'admin.orders.*', 'admin.payments.*', 'admin.coupons.*') ? 'true' : 'false' }}">
                <i class="bi bi-bag-check me-2"></i> E-Commerce
            </a>
            <div class="collapse {{ request()->routeIs('admin.categories.*', 'admin.products.*', 'admin.orders.*', 'admin.payments.*', 'admin.coupons.*') ? 'show' : '' }}"
                id="collapseEcommerce">
                <ul class="nav flex-column mt-1">
                    <li class="nav-item">
                        <a class="nav-link {{ is_active_route('admin.categories.index') }}"
                            href="{{ route('admin.categories.index') }}">
                            Categories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ is_active_route('admin.products.index') }}"
                            href="{{ route('admin.products.index') }}">
                            Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ is_active_route('admin.orders.index') }}"
                            href="{{ route('admin.orders.index') }}">
                            Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ is_active_route('admin.payments.index') }}"
                            href="{{ route('admin.payments.index') }}">
                            Payments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ is_active_route('admin.coupons.index') }}"
                            href="{{ route('admin.coupons.index') }}">
                            Coupons
                        </a>
                    </li>
                </ul>
            </div>
        </li> --}}

{{-- Users --}}
{{-- <li class="nav-item">
            <a class="nav-link {{ is_active_parent('admin.users') }}" data-bs-toggle="collapse"
                href="#collapseUsers" role="button">
                <i class="bi bi-people me-2"></i> Users
            </a>
            <div class="collapse {{ is_active_prefix('admin.users') }}" id="collapseUsers">
                <ul class="nav flex-column mt-1">
                    <li class="nav-item">
                        <a class="nav-link {{ is_active_route('admin.users.index') }}"
                            href="{{ route('admin.users.index') }}">
                            All Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.create') }}">
                            Add User
                        </a>
                    </li>
                </ul>
            </div>
        </li> --}}

{{-- Affiliates Admin --}}
{{-- <li class="nav-item">
            <a class="nav-link {{ is_active_parent('admin.affiliates') }} {{ is_active_parent('admin.affiliate-payouts') }}"
                data-bs-toggle="collapse" href="#collapseAffiliatesAdmin" role="button">
                <i class="bi bi-diagram-3 me-2"></i> Affiliates
            </a>
            <div class="collapse {{ request()->routeIs('admin.affiliates.*', 'admin.affiliate-payouts.*') ? 'show' : '' }}"
                id="collapseAffiliatesAdmin">
                <ul class="nav flex-column mt-1">
                    <li class="nav-item">
                        <a class="nav-link {{ is_active_route('admin.affiliates.index') }}"
                            href="{{ route('admin.affiliates.index') }}">
                            Affiliates List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ is_active_route('admin.affiliate-payouts.index') }}"
                            href="{{ route('admin.affiliate-payouts.index') }}">
                            Affiliate Payouts
                        </a>
                    </li>
                </ul>
            </div>
        </li> --}}

{{-- Settings --}}
{{-- <li class="nav-item">
            <a class="nav-link {{ is_active_route('admin.settings.edit') }}"
                href="{{ route('admin.settings.edit') }}">
                <i class="bi bi-gear me-2"></i> Settings
            </a>
        </li>
    </ul> --}}

{{-- <div class="sidebar-divider"></div> --}}

{{-- AFFILIATE USER SECTION --}}
{{-- <div class="section-title">Affiliate Area</div>
    <ul class="nav nav-pills flex-column gap-1">
        <li class="nav-item">
            <a class="nav-link {{ is_active_route('affiliate.dashboard') }}"
                href="{{ route('affiliate.dashboard') }}">
                <i class="bi bi-bar-chart me-2"></i> Affiliate Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ is_active_route('affiliate.referrals') }}"
                href="{{ route('affiliate.referrals') }}">
                <i class="bi bi-people-fill me-2"></i> Referrals
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ is_active_route('affiliate.payouts') }}" href="{{ route('affiliate.payouts') }}">
                <i class="bi bi-cash-stack me-2"></i> My Payouts
            </a>
        </li>
    </ul>

    <div class="sidebar-divider"></div> --}}

{{-- Logout --}}
{{-- <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-outline-light w-100">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </button>
    </form>
</aside> --}}

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
            <li class="nav-item">
                <a class="nav-link {{ is_active_route('admin.dashboard') }}" href="{{ route('admin.dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

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
    {{-- <div class="sidenav-footer mx-3 ">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <img class="w-50 mx-auto" src="../assets/img/illustrations/icon-documentation.svg"
                alt="sidebar_illustration">
            <div class="card-body text-center p-3 w-100 pt-0">
                <div class="docs-info">
                    <h6 class="mb-0">Need help?</h6>
                    <p class="text-xs font-weight-bold mb-0">Please check our docs</p>
                </div>
            </div>
        </div>
        <a href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard" target="_blank"
            class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>
        <a class="btn btn-primary btn-sm mb-0 w-100"
            href="https://www.creative-tim.com/product/argon-dashboard-pro?ref=sidebarfree" type="button">Upgrade
            to pro</a>
    </div> --}}
</aside>

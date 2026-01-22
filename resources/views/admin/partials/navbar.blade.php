@php
    $pageTitle = $title ?? (trim($__env->yieldContent('page_title')) ?? 'Dashboard');
    $pageParent = trim($__env->yieldContent('page_parent')) ?: 'Dashboard';
@endphp

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
    data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">
                    <a class="opacity-5 text-white" href="{{ route('admin.dashboard') }}">{{ $pageParent }}</a>
                </li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">
                    {{ $pageTitle }}
                </li>
            </ol>

            <h6 class="font-weight-bolder text-white mb-0">{{ $pageTitle }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Type here...">
                </div>
            </div>
            <ul class="navbar-nav  justify-content-end">
                <!-- User Profile Dropdown -->
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0 d-flex align-items-center" id="userDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <!-- User Avatar -->
                            @if (Auth::user()->avatar)
                                <img src="{{ Storage::url(Auth::user()->avatar) }}"
                                    class="avatar avatar-sm rounded-circle me-2" alt="{{ Auth::user()->name }}">
                            @else
                                <div
                                    class="avatar avatar-sm bg-gradient-primary rounded-circle d-flex align-items-center justify-content-center me-2">
                                    <span class="text-white" style="font-size: 0.8rem;">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                            <div class="d-flex flex-column">
                                <span class="text-sm font-weight-bold">{{ Auth::user()->name }}</span>
                                <small class="text-xs opacity-7">
                                    {{ Auth::user()->getRoleNames()->first() ?? 'User' }}
                                </small>
                            </div>
                            <i class="fas fa-chevron-down ms-2 text-xs"></i>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="userDropdown">
                        <!-- Profile Link -->
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md"
                                href="{{ route('admin.users.edit', Auth::user()) }}">
                                <div class="d-flex align-items-center">
                                    <div
                                        class="icon icon-shape icon-sm bg-gradient-primary rounded-circle me-3 text-center">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-sm font-weight-normal mb-0">My Profile</h6>
                                        <p class="text-xs text-secondary mb-0">View and edit profile</p>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <!-- Settings Link -->
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="{{ route('admin.settings.edit') }}">
                                <div class="d-flex align-items-center">
                                    <div
                                        class="icon icon-shape icon-sm bg-gradient-info rounded-circle me-3 text-center">
                                        <i class="fas fa-cog text-white"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-sm font-weight-normal mb-0">Settings</h6>
                                        <p class="text-xs text-secondary mb-0">System settings</p>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <!-- Logout Button -->
                        <li>
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <a class="dropdown-item border-radius-md text-danger" href="#"
                                    onclick="event.preventDefault(); confirmLogout();">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="icon icon-shape icon-sm bg-gradient-danger rounded-circle me-3 text-center">
                                            <i class="fas fa-sign-out-alt text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-sm font-weight-normal mb-0">Logout</h6>
                                            <p class="text-xs text-secondary mb-0">Sign out from system</p>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>

                <!-- Bell Notifications -->
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0 position-relative" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer"></i>
                        @php
                            $unreadCount = 0; // You can set this from database
                        @endphp
                        @if ($unreadCount > 0)
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                style="font-size: 0.6rem;">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                            <h6 class="text-dark font-weight-bolder mb-0">Notifications</h6>
                            <small class="text-muted">{{ now()->format('M d, Y') }}</small>
                        </li>
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <div
                                            class="icon icon-shape icon-sm bg-gradient-success rounded-circle me-3 text-center">
                                            <i class="fas fa-check text-white"></i>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">System Update</span> completed
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            13 minutes ago
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <div
                                            class="icon icon-shape icon-sm bg-gradient-info rounded-circle me-3 text-center">
                                            <i class="fas fa-user-plus text-white"></i>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">New user</span> registered
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            1 hour ago
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <div
                                            class="icon icon-shape icon-sm bg-gradient-warning rounded-circle me-3 text-center">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            System maintenance scheduled
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            2 days
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item text-center text-primary font-weight-bold" href="javascript:;">
                                View all notifications
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Settings Icon -->
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" title="Theme Settings">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>

                <!-- Mobile Menu Toggle -->
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="icon icon-shape icon-lg bg-gradient-danger rounded-circle mx-auto mb-3">
                    <i class="fas fa-sign-out-alt text-white"></i>
                </div>
                <h5 class="mb-2">Are you sure you want to logout?</h5>
                <p class="text-sm text-muted mb-0">You will need to login again to access the system.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="performLogout()">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .avatar {
        width: 32px;
        height: 32px;
        object-fit: cover;
    }


    /* .icon-lg i {
        top: 0px;
    } */
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Logout confirmation function
        window.confirmLogout = function() {
            const logoutModal = new bootstrap.Modal(document.getElementById('logoutModal'));
            logoutModal.show();
        };

        // Perform logout
        window.performLogout = function() {
            document.getElementById('logout-form').submit();
        };

        // Auto-hide dropdowns on click outside
        document.addEventListener('click', function(event) {
            const dropdowns = document.querySelectorAll('.dropdown-menu.show');
            dropdowns.forEach(function(dropdown) {
                if (!dropdown.parentElement.contains(event.target)) {
                    const bsDropdown = bootstrap.Dropdown.getInstance(dropdown.parentElement
                        .querySelector('.dropdown-toggle'));
                    if (bsDropdown) {
                        bsDropdown.hide();
                    }
                }
            });
        });

        // Mobile sidebar toggle
        const iconNavbarSidenav = document.getElementById('iconNavbarSidenav');
        if (iconNavbarSidenav) {
            iconNavbarSidenav.addEventListener('click', function() {
                const sidebar = document.querySelector('.sidenav');
                if (sidebar) {
                    sidebar.classList.toggle('g-sidenav-pinned');
                    document.body.classList.toggle('g-sidenav-show');
                }
            });
        }

        // Update last activity time for session management
        function updateLastActivity() {
            if (typeof localStorage !== 'undefined') {
                localStorage.setItem('last_activity', Date.now());
            }
        }

        // Update activity on user interaction
        ['click', 'keypress', 'scroll', 'mousemove'].forEach(event => {
            document.addEventListener(event, updateLastActivity, {
                passive: true
            });
        });

        // Check session expiry every minute
        setInterval(function() {
            const lastActivity = localStorage.getItem('last_activity');
            const sessionLifetime = {{ config('session.lifetime', 120) }} * 60 *
                1000; // Convert to milliseconds

            if (lastActivity && (Date.now() - lastActivity > sessionLifetime)) {
                // Show session expiry warning
                Swal.fire({
                    title: 'Session Expired',
                    text: 'Your session has expired. Please login again.',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('logout-form').submit();
                    }
                });
            }
        }, 60000); // Check every minute
    });
</script>

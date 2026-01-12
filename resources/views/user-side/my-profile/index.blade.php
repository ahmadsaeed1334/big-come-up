@extends('layouts.user-side')

@section('content')
    <div class="profile-shell">
        {{-- NAVBAR --}}
        @include('user-side.partials.navbar')

        {{-- PROFILE HERO --}}
        <section class="profile-hero">
            <div class="container">
                <div class="profile-hero-inner">
                    {{-- RIGHT SIDE ACTIONS --}}
                    <div class="hero-icon-group">
                        <button class="hero-circle-icon">
                            <i class="bi bi-music-note-beamed"></i>
                        </button>
                        <button class="hero-circle-icon">
                            <i class="bi bi-bell"></i>
                        </button>
                        <button class="hero-circle-icon">
                            <i class="bi bi-bookmark-fill"></i>
                        </button>
                        <button class="hero-circle-icon" id="openSettingsModal">
                            <i class="bi bi-gear-fill"></i>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- SETTINGS MODAL --}}
    <div class="settings-modal-overlay" id="settingsModal">
        <div class="settings-modal-container">
            {{-- SIDEBAR --}}
            <div class="settings-sidebar">
                <div class="settings-sidebar-header">
                    <div class="user-profile-mini">
                        <img src="{{ asset('assets/images/profile1.jpg') }}" alt="Profile" class="profile-mini-img">
                        <div class="profile-mini-info">
                            <h4>Thomas Moller</h4>
                            <button class="edit-profile-btn">
                                Edit Profile <i class="bi bi-pencil"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="settings-search">
                    <input type="text" placeholder="Search" class="settings-search-input">
                    <i class="bi bi-search"></i>
                </div>

                <div class="settings-menu">
                    <p class="settings-menu-label">User Setting</p>

                    <button class="settings-menu-item active" data-section="account">
                        <i class="bi bi-person-fill"></i>
                        <span>Account Setting</span>
                    </button>

                    <button class="settings-menu-item" data-section="security">
                        <i class="bi bi-shield-fill-check"></i>
                        <span>Security Settings</span>
                    </button>

                    <button class="settings-menu-item" data-section="notification">
                        <i class="bi bi-bell-fill"></i>
                        <span>Notification Settings</span>
                    </button>

                    <button class="settings-menu-item" data-section="privacy">
                        <i class="bi bi-lock-fill"></i>
                        <span>Privacy Settings</span>
                    </button>

                    <button class="settings-menu-item" data-section="content">
                        <i class="bi bi-file-earmark-text-fill"></i>
                        <span>Content Preferences</span>
                    </button>

                    <button class="settings-menu-item" data-section="sweepstakes">
                        <i class="bi bi-trophy-fill"></i>
                        <span>Sweepstakes Settings</span>
                    </button>

                    <button class="settings-menu-item" data-section="community">
                        <i class="bi bi-people-fill"></i>
                        <span>Community Settings</span>
                    </button>

                    <button class="settings-menu-item" data-section="management">
                        <i class="bi bi-grid-fill"></i>
                        <span>Account Management</span>
                    </button>
                </div>
            </div>

            {{-- CONTENT AREA --}}
            <div class="settings-content">
                <div class="settings-content-header">
                    <h2>Settings</h2>
                    <button class="close-modal-btn" id="closeSettingsModal">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="settings-content-body">
                    <div class="settings-section" id="section-account">
                        {{-- PROFILE BANNER --}}
                        <div class="profile-banner-section">
                            <img src="{{ asset('assets/images/profile-hero.jpg') }}" alt="Banner"
                                class="profile-banner-img">
                            <div class="profile-banner-overlay">
                                <img src="{{ asset('assets/images/profile1.jpg') }}" alt="Profile"
                                    class="profile-banner-avatar">
                                <h3>Thomas Moller</h3>
                            </div>
                        </div>

                        {{-- ACCOUNT SETTINGS FORM --}}
                        <div class="settings-form-section">
                            <div class="settings-field">
                                <label>Display Name</label>
                                <div class="field-row">
                                    <span class="field-value">Thomas Moller</span>
                                    <button class="edit-field-btn">Edit</button>
                                </div>
                            </div>

                            <div class="settings-field">
                                <label>Username:</label>
                                <div class="field-row">
                                    <span class="field-value">@Aleja</span>
                                    <button class="edit-field-btn">Edit</button>
                                </div>
                            </div>

                            <div class="settings-field">
                                <label>Email Address:</label>
                                <div class="field-row">
                                    <span class="field-value">alexjonson@gmail.com</span>
                                    <button class="edit-field-btn">Edit</button>
                                </div>
                            </div>

                            <div class="settings-field">
                                <label>Phone Number</label>
                                <div class="field-row">
                                    <span class="field-value">+92-34576344</span>
                                    <button class="edit-field-btn">Edit</button>
                                </div>
                            </div>

                            <div class="settings-field">
                                <label>Country</label>
                                <div class="field-row">
                                    <span class="field-value">United States</span>
                                    <button class="edit-field-btn">Edit</button>
                                </div>
                            </div>

                            <div class="settings-field">
                                <label>Date Of Birth</label>
                                <div class="field-row">
                                    <span class="field-value">March 14, 1998</span>
                                    <button class="edit-field-btn">Edit</button>
                                </div>
                            </div>

                            {{-- ACTION BUTTONS --}}
                            <div class="settings-actions">
                                <button class="cancel-btn">Cancel</button>
                                <button class="save-btn">Save Changes</button>
                            </div>
                        </div>
                    </div>

                    {{-- SECURITY SETTINGS SECTION --}}
                    <div class="settings-section" id="section-security" style="display:none;">

                        {{-- PASSWORD --}}
                        <div class="security-simple-row">
                            <div>
                                <h4>Password</h4>
                                <p>Last Updated : 2 Months Ago</p>
                            </div>
                            <button class="edit-field-btn">Change Password</button>
                        </div>

                        {{-- 2FA --}}
                        <div class="security-simple-row">
                            <div>
                                <h4>Two Factor Authenticator</h4>
                                <p class="status-enabled">Enabled</p>
                            </div>
                            <button class="edit-field-btn">Disable 2FA</button>
                        </div>

                        {{-- LOGIN HISTORY CARD --}}
                        <div class="login-history-card">
                            <div class="login-history-header">
                                <h4>Login History</h4>
                                <span class="active-devices">2 Active Devices</span>
                            </div>

                            <ul class="login-history-list">
                                <li>
                                    Chrome · Los Angeles · Today, 10:42 AM
                                    <button class="logout-link">Logout</button>
                                </li>
                                <li>
                                    Chrome · Los Angeles · Today, 10:42 AM
                                    <button class="logout-link">Logout</button>
                                </li>
                                <li>
                                    Chrome · Los Angeles · Today, 10:42 AM
                                    <button class="logout-link">Logout</button>
                                </li>
                            </ul>
                        </div>

                    </div>

                    {{-- NOTIFICATION SETTINGS SECTION --}}
                    <div class="settings-section" id="section-notification" style="display:none;">

                        {{-- EMAIL NOTIFICATIONS --}}
                        <div class="notification-card">
                            <h4 class="notification-title">Email Notifications</h4>

                            <div class="notification-row">
                                <span>Competition Updates</span>
                                <input type="checkbox" class="notify-input" checked hidden>

                                <button type="button" class="notify-radio active"></button>
                            </div>

                            <div class="notification-row">
                                <span>Voting Reminders</span>
                                <input type="checkbox" class="notify-input" checked hidden>

                                <button type="button" class="notify-radio "></button>
                            </div>

                            <div class="notification-row">
                                <span>Sweepstakes Results</span>
                                <input type="checkbox" class="notify-input" checked hidden>

                                <button type="button" class="notify-radio "></button>
                            </div>

                            <div class="notification-row">
                                <span>Radio Show Alerts</span>
                                <input type="checkbox" class="notify-input" checked hidden>
                                <button type="button" class="notify-radio active"></button>
                            </div>

                            <div class="notification-row">
                                <span>Platform Announcements</span>
                                <input type="checkbox" class="notify-input" checked hidden>
                                <button type="button" class="notify-radio active"></button>
                            </div>
                        </div>

                        {{-- PUSH NOTIFICATIONS --}}
                        <div class="notification-card">
                            <h4 class="notification-title">Push Notifications</h4>

                            <div class="notification-row">
                                <span>Live Competitions</span>
                                <input type="checkbox" class="notify-input" checked hidden>
                                <button type="button" class="notify-radio active"></button>
                            </div>

                            <div class="notification-row">
                                <span>New Performances</span>
                                <input type="checkbox" class="notify-input" checked hidden>
                                <button type="button" class="notify-radio"></button>
                            </div>

                            <div class="notification-row">
                                <span>Winner Announcements</span>
                                <input type="checkbox" class="notify-input" checked hidden>
                                <button type="button" class="notify-radio active"></button>
                            </div>

                            <div class="notification-row">
                                <span>Community Activity</span>
                                <input type="checkbox" class="notify-input" checked hidden>
                                <button type="button" class="notify-radio active"></button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- =============================
    PROFILE CONTENT SECTION
      ============================= --}}
    <section class="profile-content">
        <div class="container">
            <div class="row g-4 ">
                {{-- LEFT SIDEBAR --}}
                <div class="col-lg-3">
                    <div class="profile-sidebar">
                        {{-- avatar --}}
                        <div class="profile-avatar">
                            <img src="{{ asset('assets/images/profile1.jpg') }}" alt="Thomas Moiler">
                        </div>
                        <h3 class="profile-name">Thomas Moiler</h3>
                        <p class="profile-location">
                            <i class="bi bi-geo-alt"></i>
                            London, United Kingdom
                        </p>
                        <hr class="profile-divider">
                        <p class="profile-bio">
                            DJ Nova is a Los Angeles–based electronic DJ blending future bass and electro house.
                            Known for high-energy festival sets and precision transitions.
                        </p>
                        {{-- stats --}}
                        <div class="profile-tags">
                            <span>Followers: 128k</span>
                            <span>Total Votes Earned: 98,400</span>
                            <span>Competitions Participated: 12</span>
                            <span>Wins: 2</span>
                        </div>
                        {{-- tags --}}
                        {{-- <h5 class="profile-tags-title">Tags</h5>
                        <div class="profile-tags">
                            <span>EDM</span>
                            <span>Future Bass</span>
                            <span>Electro House</span>
                        </div> --}}

                    </div>
                </div>
                {{-- RIGHT CONTENT --}}
                <div class="col-lg-9">
                    {{-- TABS --}}
                    <div class="profile-tabs mb-4">
                        <button class="profile-tab-btn active" data-tab="performances-watched">Performances
                            Watched</button>
                        <button class="profile-tab-btn" data-tab="voted-videos">Voted Videos</button>
                        <button class="profile-tab-btn" data-tab="comments-posted">Comments Posted</button>
                        <button class="profile-tab-btn" data-tab="votes-cast">Votes Cast</button>
                    </div>
                    {{-- TAB CONTENTS --}}
                    {{-- Performances Watched --}}
                    <div class="tab-content-profile active" id="tab-performances-watched">

                        {{-- Performance Card --}}
                        @for ($i = 0; $i < 3; $i++)
                            <div class="performance-card">
                                <div class="performance-left">
                                    <img src="{{ asset('assets/images/video-thumb.jpg') }}" alt="Midnight Surge">

                                    <span class="platform-badge">Instagram</span>
                                </div>

                                <div class="performance-middle">
                                    <h5 class="performance-title">Midnight Surge</h5>
                                    <p class="performance-meta">
                                        Votes: 15,920 &nbsp; | &nbsp; Rank: <strong>Top 10</strong>
                                    </p>

                                    <button class="watch-btn">Watch Video</button>
                                </div>

                                <div class="performance-right">
                                    <span class="time-text">20 mins ago</span>
                                </div>
                            </div>
                        @endfor

                    </div>

                    {{-- Voted Videos --}}
                    <div class="tab-content-profile " id="tab-voted-videos">
                        {{-- Voted Videos --}}
                        @for ($i = 0; $i < 3; $i++)
                            <div class="performance-card">
                                <div class="performance-left">
                                    <img src="{{ asset('assets/images/video-thumb.jpg') }}" alt="Midnight Surge">

                                    <span class="platform-badge">Instagram</span>
                                </div>

                                <div class="performance-middle">
                                    <h5 class="performance-title">Midnight Surge</h5>
                                    <p class="performance-meta">
                                        Votes: 15,920 &nbsp; | &nbsp; Rank: <strong>Top 10</strong>
                                    </p>

                                    <button class="watch-btn">Watch Video</button>
                                </div>

                                <div class="performance-right">
                                    <span class="time-text">20 mins ago</span>
                                </div>
                            </div>
                        @endfor
                    </div>

                    {{-- COMMENTS POSTED TAB --}}
                    <div class="tab-content-profile active" id="tab-comments-posted">

                        {{-- Comment Card --}}
                        @for ($i = 0; $i < 4; $i++)
                            <div class="comment-card-profile">
                                <div class="comment-card-left">
                                    <p class="comment-text">
                                        “This beat drop was insane 🔥”
                                    </p>
                                    <p class="comment-on">
                                        On: <strong>DJ Nova — Midnight Surge</strong>
                                    </p>
                                </div>

                                <div class="comment-card-right">
                                    <span class="comment-time">Posted: 20 mins ago</span>
                                    <button class="comment-menu">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                </div>
                            </div>
                        @endfor

                    </div>

                    {{-- Votes Cast --}}
                    <div class="tab-content-profile " id="tab-votes-cast">
                        {{-- Votes Cast --}}
                        @for ($i = 0; $i < 3; $i++)
                            <div class="performance-card">
                                <div class="performance-left">
                                    <img src="{{ asset('assets/images/video-thumb.jpg') }}" alt="Midnight Surge">

                                    <span class="platform-badge">Instagram</span>
                                </div>

                                <div class="performance-middle">
                                    <h5 class="performance-title">Midnight Surge</h5>
                                    <p class="performance-meta">
                                        Votes: 15,920 &nbsp; | &nbsp; Rank: <strong>Top 10</strong>
                                    </p>

                                    <button class="watch-btn">Watch Video</button>
                                </div>

                                <div class="performance-right">
                                    <span class="time-text">Vote Date : 2 days ago</span>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tabButtons = document.querySelectorAll(".profile-tab-btn");
            const tabContents = document.querySelectorAll(".tab-content-profile ");

            tabButtons.forEach(btn => {
                btn.addEventListener("click", () => {
                    // remove active from all buttons
                    tabButtons.forEach(b => b.classList.remove("active"));
                    // hide all contents
                    tabContents.forEach(c => c.classList.remove("active"));

                    // add active to clicked button
                    btn.classList.add("active");

                    // show matching tab content
                    const tabName = btn.getAttribute("data-tab");
                    const activeTab = document.getElementById("tab-" + tabName);

                    if (activeTab) {
                        activeTab.classList.add("active");
                    }
                });
            });
        });
    </script>
    <script>
        // Modal Open/Close
        const settingsModal = document.getElementById('settingsModal');
        const openBtn = document.getElementById('openSettingsModal');
        const closeBtn = document.getElementById('closeSettingsModal');

        openBtn.addEventListener('click', () => {
            settingsModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        closeBtn.addEventListener('click', () => {
            settingsModal.classList.remove('active');
            document.body.style.overflow = 'auto';
        });

        // Close on overlay click
        settingsModal.addEventListener('click', (e) => {
            if (e.target === settingsModal) {
                settingsModal.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });

        // Menu Item Selection
        const menuItems = document.querySelectorAll('.settings-menu-item');

        menuItems.forEach(item => {
            item.addEventListener('click', () => {
                menuItems.forEach(btn => btn.classList.remove('active'));
                item.classList.add('active');

                // Here you can add logic to switch content sections
                const section = item.getAttribute('data-section');
                console.log('Selected section:', section);
            });
        });

        const sections = document.querySelectorAll('.settings-section');

        menuItems.forEach(item => {
            item.addEventListener('click', () => {
                menuItems.forEach(btn => btn.classList.remove('active'));
                item.classList.add('active');

                const section = item.getAttribute('data-section');

                sections.forEach(sec => sec.style.display = 'none');

                const activeSection = document.getElementById('section-' + section);
                if (activeSection) {
                    activeSection.style.display = 'block';
                }
            });
        });
    </script>
    <script>
        const menuItems = document.querySelectorAll('.settings-menu-item');
        const sections = document.querySelectorAll('.settings-section');

        menuItems.forEach(item => {
            item.addEventListener('click', () => {

                // active menu
                menuItems.forEach(btn => btn.classList.remove('active'));
                item.classList.add('active');

                // hide all sections
                sections.forEach(sec => sec.style.display = 'none');

                // show selected section
                const section = item.getAttribute('data-section');
                const activeSection = document.getElementById('section-' + section);

                if (activeSection) {
                    activeSection.style.display = 'block';
                }
            });
        });
    </script>
    <script>
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.notify-radio');
            if (!btn) return;

            e.preventDefault();

            const row = btn.closest('.notification-row');
            const input = row.querySelector('.notify-input');

            // toggle real state
            input.checked = !input.checked;

            // sync UI
            btn.classList.toggle('active', input.checked);

            // (optional) debug
            console.log('Notification:', row.querySelector('span').innerText, input.checked);
        });
    </script>
@endsection

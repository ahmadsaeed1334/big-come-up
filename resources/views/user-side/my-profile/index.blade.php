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
                        <button class="hero-circle-icon" id="openRadioModal">
                            <i class="bi bi-music-note-beamed"></i>
                        </button>

                        <button class="hero-circle-icon" id="openNotificationsModal">
                            <i class="bi bi-bell"></i>
                        </button>

                        <button class="hero-circle-icon" id="openSavedModal">
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

                    <button class="settings-menu-item" data-section="shop-preferences">
                        <i class="bi bi-shop"></i>
                        <span>Shop Preferences</span>
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

                            <div class="profile-banner-clip">
                                <img src="{{ asset('assets/images/profile-hero.jpg') }}" alt="Banner"
                                    class="profile-banner-img">
                            </div>

                            <div class="profile-banner-overlay">
                                <img src="{{ asset('assets/images/profile1.jpg') }}" alt="Profile"
                                    class="profile-banner-avatar">
                                <h3 class="profile-banner-name">Thomas Moiler</h3>
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
                    {{-- PRIVACY SETTINGS SECTION --}}
                    <div class="settings-section" id="section-privacy" style="display:none;">

                        {{-- PRIVACY SETTINGS --}}
                        <div class="notification-card">
                            <h4 class="notification-title">Privacy Setting</h4>

                            <div class="notification-row">
                                <span>Public Profile Visibility</span>
                                <input type="checkbox" class="notify-input" checked hidden>

                                <button type="button" class="notify-radio active"></button>
                            </div>

                            <div class="notification-row">
                                <span>Show Activity History </span>
                                <input type="checkbox" class="notify-input" checked hidden>

                                <button type="button" class="notify-radio "></button>
                            </div>

                            <div class="notification-row">
                                <span>show votes publicly</span>
                                <input type="checkbox" class="notify-input" checked hidden>

                                <button type="button" class="notify-radio "></button>
                            </div>

                            <div class="notification-row">
                                <span>allow direct messages</span>
                                <input type="checkbox" class="notify-input" checked hidden>
                                <button type="button" class="notify-radio active"></button>
                            </div>
                        </div>
                    </div>
                    {{-- SELECTED SETTINGS SECTION --}}
                    <div class="settings-section" id="section-content" style="display:none;">

                        {{-- SELECTED SETTINGS --}}
                        <div class="notification-card">
                            <h4 class="notification-title">Selected Interests</h4>

                            <div class="notification-row">
                                <span>DJs</span>
                                <input type="checkbox" class="notify-input" checked hidden>

                                <button type="button" class="notify-radio active"></button>
                            </div>

                            <div class="notification-row">
                                <span>Artists</span>
                                <input type="checkbox" class="notify-input" checked hidden>

                                <button type="button" class="notify-radio "></button>
                            </div>

                            <div class="notification-row">
                                <span>Dance</span>
                                <input type="checkbox" class="notify-input" checked hidden>

                                <button type="button" class="notify-radio "></button>
                            </div>

                            <div class="notification-row">
                                <span>Comedy</span>
                                <input type="checkbox" class="notify-input" checked hidden>
                                <button type="button" class="notify-radio active"></button>
                            </div>

                            <div class="notification-row">
                                <span>Radio shows</span>
                                <input type="checkbox" class="notify-input" checked hidden>
                                <button type="button" class="notify-radio active"></button>
                            </div>
                            <div class="notification-row">
                                <span>Community Stories</span>
                                <input type="checkbox" class="notify-input" checked hidden>
                                <button type="button" class="notify-radio active"></button>
                            </div>
                        </div>
                    </div>
                    {{-- sweepstakes SETTINGS SECTION --}}
                    <div class="settings-section" id="section-sweepstakes" style="display:none;">

                        {{-- Sweepstakes & Rewards Settings SETTINGS --}}
                        <div class="notification-card">
                            <h4 class="notification-title">Sweepstakes & Rewards Settings</h4>

                            <div class="notification-row">
                                <span>Receive Sweepstakes Notifications</span>
                                <input type="checkbox" class="notify-input" checked hidden>

                                <button type="button" class="notify-radio active"></button>
                            </div>

                            <div class="notification-row">
                                <span>Show My Wins Publicly</span>
                                <input type="checkbox" class="notify-input" checked hidden>

                                <button type="button" class="notify-radio "></button>
                            </div>
                        </div>
                    </div>

                    {{-- SHOP PERFORMANCE SETTINGS SECTION --}}
                    <div class="settings-section" id="section-shop-preferences" style="display:none;">

                        {{-- PASSWORD --}}
                        <div class="security-simple-row">
                            <div>
                                <h4>Saved Payment Method</h4>
                                <p>Visa •••• 4821</p>
                            </div>
                            <button class="edit-field-btn">Manage Payment Methods</button>
                        </div>

                        {{-- DOWNLOAD HISTORY CARD --}}
                        <div class="login-history-card">
                            <div class="login-history-header">
                                <h4>Download History</h4>

                            </div>

                            <ul class="login-history-list">
                                <li>
                                    Afro House Beat Pack Vol.1
                                    <button class="download-link">Download</button>
                                </li>
                                <li>
                                    Afro House Beat Pack Vol.1
                                    <button class="download-link">Download</button>
                                </li>
                                <li>
                                    Afro House Beat Pack Vol.1
                                    <button class="download-link">Download</button>
                                </li>
                            </ul>
                        </div>

                    </div>

                    {{-- SELECTED SETTINGS SECTION --}}
                    <div class="settings-section" id="section-community" style="display:none;">

                        {{-- COMMUNITY SETTINGS --}}
                        <div class="notification-card">
                            <h4 class="notification-title">Community Setting</h4>

                            <div class="notification-row">
                                <span>Allow Comments on My Profile</span>
                                <input type="checkbox" class="notify-input" checked hidden>

                                <button type="button" class="notify-radio active"></button>
                            </div>

                            <div class="notification-row">
                                <span>Show Liked Content Publicly</span>
                                <input type="checkbox" class="notify-input" checked hidden>

                                <button type="button" class="notify-radio "></button>
                            </div>

                            <div class="notification-row">
                                <span>Allow On Blast Submissions</span>
                                <input type="checkbox" class="notify-input" checked hidden>

                                <button type="button" class="notify-radio "></button>
                            </div>
                        </div>
                    </div>

                    {{-- ACCOUNT MANAGEMENT SETTINGS SECTION --}}
                    <div class="settings-section" id="section-management" style="display:none;">

                        {{-- PASSWORD --}}
                        <div class="security-simple-row">
                            <div>
                                <h4>Deactivate Account</h4>
                                <p>Temporarily disable your account. You can reactivate
                                    anytime.</p>
                            </div>
                            <button class="delete-field-btn">Deactivate</button>
                        </div>
                        <div class="security-simple-row">
                            <div>
                                <h4>Delete Account</h4>
                                <p>Permanently delete your account and all associated data.</p>
                            </div>
                            <button class="delete-field-btn">Delete Account</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SAVED MODAL --}}
    <div class="saved-modal-overlay" id="savedModal">
        <div class="saved-modal-container">

            <button class="saved-modal-close" id="closeSavedModal" type="button">
                <i class="bi bi-x-lg"></i>
            </button>

            {{-- Tabs Header --}}
            <div class="saved-modal-tabs">
                <button class="saved-tab-btn active" data-savedtab="performances" type="button">Saved
                    Performances</button>
                <button class="saved-tab-btn" data-savedtab="stories" type="button">Saved Stories</button>
            </div>

            {{-- Tabs Content --}}
            <div class="saved-modal-body">

                {{-- Saved Performances (active) --}}
                <div class="saved-tab-content active" id="savedtab-performances">

                    @for ($i = 0; $i < 6; $i++)
                        <div class="saved-performance-row">
                            <div class="saved-performance-left">
                                <img src="{{ asset('assets/images/video-thumb.jpg') }}" alt="Midnight Surge">
                                <span class="saved-platform-badge">Instagram</span>
                            </div>

                            <div class="saved-performance-mid">
                                <h6 class="saved-title">Midnight Surge</h6>
                                <p class="saved-meta">Votes: 15,920 &nbsp; | &nbsp; Rank: <strong>Top 10</strong></p>
                            </div>

                            <div class="saved-performance-right">
                                <span class="saved-duration">Duration: 4:32</span>
                                <button class="saved-action-btn" type="button" title="Saved">
                                    <i class="bi bi-bookmark-fill"></i>
                                </button>
                            </div>
                        </div>
                    @endfor

                </div>

                {{-- Saved Stories --}}
                <div class="saved-tab-content" id="savedtab-stories">

                    @for ($i = 0; $i < 7; $i++)
                        <div class="saved-story-row">
                            <div class="saved-story-left">
                                <img src="{{ asset('assets/images/video-thumb.jpg') }}" alt="Exposed on Live Stream">
                            </div>

                            <div class="saved-story-mid">
                                <h6 class="saved-story-title">“Exposed on Live Stream”</h6>
                                <p class="saved-story-meta">Category: Viral Moment</p>
                            </div>

                            <div class="saved-story-right">
                                <span class="saved-story-time">Saved: 2 days ago</span>
                                <button class="saved-action-btn" type="button" title="Saved">
                                    <i class="bi bi-bookmark-fill"></i>
                                </button>
                            </div>
                        </div>
                    @endfor

                </div>


            </div>
        </div>
    </div>

    {{-- NOTIFICATIONS MODAL --}}
    <div class="notify-modal-overlay" id="notificationsModal">
        <div class="notify-modal-container">

            <button class="notify-modal-close" id="closeNotificationsModal" type="button">
                <i class="bi bi-x-lg"></i>
            </button>

            <div class="notify-modal-header">
                <h4 class="notify-title">Notifications</h4>
            </div>

            <div class="notify-divider"></div>

            <div class="notify-modal-body">

                <div class="notify-item notify-item-highlight">
                    <div class="notify-item-left">
                        <div class="notify-item-title">Sweepstakes Update</div>
                        <div class="notify-item-desc">You’ve successfully entered the $1,000 Fan Giveaway.</div>
                    </div>
                    <div class="notify-item-time">11:54am</div>
                </div>

                <div class="notify-item">
                    <div class="notify-item-left">
                        <div class="notify-item-title">New Message from @Samantha</div>
                        <div class="notify-item-desc">“Hi, I had a quick question about the repayment terms...”</div>
                    </div>
                    <div class="notify-item-time">11:54am</div>
                </div>

                <div class="notify-item">
                    <div class="notify-item-left">
                        <div class="notify-item-title">Competition Update</div>
                        <div class="notify-item-desc">Global DJ Battle 2025 voting has ended.</div>
                    </div>
                    <div class="notify-item-time">11:54am</div>
                </div>

                <div class="notify-item">
                    <div class="notify-item-left">
                        <div class="notify-item-title">Live Now</div>
                        <div class="notify-item-desc">DJ Nova is live on Radio — tune in now.</div>
                    </div>
                    <div class="notify-item-time">11:54am</div>
                </div>

            </div>
        </div>
    </div>
    {{-- RADIO ACTIVITY MODAL --}}
    <div class="radio-modal-overlay" id="radioModal">
        <div class="radio-modal-container">

            <button class="radio-modal-close" id="closeRadioModal" type="button">
                <i class="bi bi-x-lg"></i>
            </button>

            <div class="radio-modal-header">
                <h4 class="radio-title">Radio Activity</h4>
            </div>

            <div class="radio-divider"></div>

            <div class="radio-modal-body">
                @for ($i = 0; $i < 3; $i++)
                    <div class="radio-card">

                        <div class="radio-card-left">
                            <img src="{{ asset('assets/images/dj-nova.jpg') }}" alt="DJ Nova"
                                onerror="this.style.display='none'; this.parentElement.classList.add('radio-img-missing');">
                        </div>

                        <div class="radio-card-right">

                            <div class="radio-topline">
                                <span class="radio-starts">Starts in: 1 Hour</span>
                                <span class="radio-duration">45 mins</span>
                            </div>

                            <h5 class="radio-card-title">DJ Nova – The Late Night Set</h5>

                            <p class="radio-desc">
                                A high-energy blend of beats, music, and live audience vibes — the perfect late-night
                                experience.
                            </p>

                            <div class="radio-wave-wrap">
                                <div class="radio-wave-row">
                                    <button class="radio-play-btn" type="button" aria-label="Play">
                                        <i class="bi bi-play-fill"></i>
                                    </button>

                                    <div class="radio-waveform" aria-hidden="true">
                                        @for ($b = 0; $b < 90; $b++)
                                            <span></span>
                                        @endfor
                                    </div>
                                </div>

                                <div class="radio-actions">
                                    <button class="radio-play-again" type="button">Play Again</button>
                                </div>
                            </div>

                        </div>
                    </div>
                @endfor
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
                            Music lover. Entertainment enthusiast. Supporting rising talent worldwide.
                        </p>
                        {{-- stats --}}
                        <div class="profile-tags">
                            <span>Artists Followed: 128k</span>
                            <span>Competitions : 98,400</span>
                            <span>Liked Stories : 12</span>

                        </div>
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
                    <div class="tab-content-profile " id="tab-comments-posted">

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

            const radioModalEl = document.getElementById('radioModal');
            const openRadioBtn = document.getElementById('openRadioModal');
            const closeRadioBtn = document.getElementById('closeRadioModal');

            if (openRadioBtn && radioModalEl) {
                openRadioBtn.addEventListener('click', () => {
                    radioModalEl.classList.add('active');
                    document.body.style.overflow = 'hidden';
                });
            }

            if (closeRadioBtn && radioModalEl) {
                closeRadioBtn.addEventListener('click', () => {
                    radioModalEl.classList.remove('active');
                    document.body.style.overflow = 'auto';
                });
            }

            if (radioModalEl) {
                radioModalEl.addEventListener('click', (e) => {
                    if (e.target === radioModalEl) {
                        radioModalEl.classList.remove('active');
                        document.body.style.overflow = 'auto';
                    }
                });
            }

        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const notificationsModalEl = document.getElementById('notificationsModal');
            const openNotificationsBtn = document.getElementById('openNotificationsModal');
            const closeNotificationsBtn = document.getElementById('closeNotificationsModal');

            if (openNotificationsBtn && notificationsModalEl) {
                openNotificationsBtn.addEventListener('click', () => {
                    notificationsModalEl.classList.add('active');
                    document.body.style.overflow = 'hidden';
                });
            }

            if (closeNotificationsBtn && notificationsModalEl) {
                closeNotificationsBtn.addEventListener('click', () => {
                    notificationsModalEl.classList.remove('active');
                    document.body.style.overflow = 'auto';
                });
            }

            if (notificationsModalEl) {
                notificationsModalEl.addEventListener('click', (e) => {
                    if (e.target === notificationsModalEl) {
                        notificationsModalEl.classList.remove('active');
                        document.body.style.overflow = 'auto';
                    }
                });
            }

        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // ===== Saved Modal Open/Close =====
            const savedModal = document.getElementById('savedModal');
            const openSavedBtn = document.getElementById('openSavedModal');
            const closeSavedBtn = document.getElementById('closeSavedModal');

            if (openSavedBtn && savedModal) {
                openSavedBtn.addEventListener('click', () => {
                    savedModal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                });
            }

            if (closeSavedBtn && savedModal) {
                closeSavedBtn.addEventListener('click', () => {
                    savedModal.classList.remove('active');
                    document.body.style.overflow = 'auto';
                });
            }

            // close on overlay click
            if (savedModal) {
                savedModal.addEventListener('click', (e) => {
                    if (e.target === savedModal) {
                        savedModal.classList.remove('active');
                        document.body.style.overflow = 'auto';
                    }
                });
            }

            // ===== Saved Modal Tabs =====
            const savedTabButtons = document.querySelectorAll('.saved-tab-btn');
            const savedTabContents = document.querySelectorAll('.saved-tab-content');

            savedTabButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    savedTabButtons.forEach(b => b.classList.remove('active'));
                    savedTabContents.forEach(c => c.classList.remove('active'));

                    btn.classList.add('active');

                    const tab = btn.getAttribute('data-savedtab'); // performances | stories
                    const active = document.getElementById('savedtab-' + tab);

                    if (active) active.classList.add('active');
                });
            });

        });
    </script>
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

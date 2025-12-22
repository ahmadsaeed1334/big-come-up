@extends('layouts.user-side')

@section('content')
    {{-- ===== HERO SHELL (same dots + gradient like home hero) ===== --}}
    <div class="hero-shell ">
        {{-- navbar include --}}
        @include('user-side.partials.navbar')

        <section class="comp-hero">
            <div class="container">
                <div class="hero-glass text-center">

                    <!-- existing content SAME -->
                    <div class="crumb-pill mx-auto mb-3">
                        Home - Competitions - DJ Competition -<strong>DJ Nova</strong>
                    </div>

                    <h1 class="display-5 fw-bold text-white mb-2">
                        Midnight Surge – Live DJ Set
                    </h1>

                    <div class="d-flex justify-content-center align-items-center gap-2 text-white-50 mb-4">
                        <span class="live-dot"></span>
                        <span class="fw-semibold text-white">LIVE</span>
                        <span>•</span>
                        <span class="fw-semibold text-white">$10,000 Grand Prize</span>
                    </div>
                </div>
            </div>
        </section>

    </div>

    {{-- ===== VIDEO STAGE (WHITE) - overlaps hero like figma ===== --}}
    <section class="video-stage">
        <div class="container">
            <div class="video-card-wrap mx-auto">

                {{-- video card --}}
                <div class="video-card position-relative">
                    {{-- badges --}}
                    <div class="video-badges d-flex gap-2">
                        <span class="badge-amber">TRENDING 🇺🇸 USA</span>
                        <span class="badge-amber">15,920 VOTES</span>
                    </div>
                    <div class="video-badges-right">
                        <span class="badge-red">YOUTUBE</span>
                    </div>

                    <div class="ratio ratio-16x9">
                        {{-- Replace VIDEO_ID --}}
                        <iframe src="https://www.youtube.com/embed/VIDEO_ID" title="Competition Video"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>


            </div>

        </div>

    </section>
    {{-- buttons are OUTSIDE video card (figma style) --}}
    <div class="video-actions d-flex justify-content-center gap-3 flex-wrap">
        <a class="btn btn-cta-amber btn-sm-pill" href="#">
            Vote Artist <span class="btn-arrow">→</span>
        </a>

        <a class="btn btn-share-pill btn-sm-pill" href="#">
            Share Performance
            <i class="bi bi-share-fill ms-2"></i>
        </a>
    </div>



    {{-- ===== TABS + CONTENT (MAROON) - this comes UP behind actions ===== --}}
    <section class="artist-section">
        <div class="container">

            <!-- Section Heading -->
            <h2 class="artist-heading text-center mb-4">Artist</h2>

            <!-- Artist Card -->
            <div class="artist-card mx-auto">

                <!-- Cover Image -->
                <div class="artist-cover">
                    <img src="{{ asset('assets/images/artist.png') }}" alt="Artist Cover">
                </div>
                <div class="d-flex justify-content-end me-4">
                    <!-- Avatar -->
                    <div class="artist-avatar">
                        <img src="{{ asset('assets/images/profile1.jpg') }}" alt="DJ Solaris">
                    </div>

                    <!-- Right Social + Followers -->
                    <div class="artist-social-wrap d-flex align-items-center gap-3">
                        <a href="#" class="social-pill">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="social-pill">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                        <a href="#" class="social-pill">
                            <i class="bi bi-instagram"></i>
                        </a>

                        <div class="artist-followers-pill">
                            128,400 Followers
                        </div>
                    </div>
                </div>
                <!-- Body -->
                <div class="artist-body">

                    <!-- Top Row -->
                    <div class="artist-top d-flex justify-content-between align-items-center gap-3 flex-wrap">

                        <!-- Left Info -->
                        <div>
                            <h3 class="artist-name">DJ Solaris – DJ</h3>
                            <div class="artist-loc">
                                <i class="bi bi-geo-alt"></i>
                                London, United Kingdom
                            </div>
                        </div>


                    </div>

                    <!-- Actions -->
                    <div class="artist-actions row g-3 mt-4">
                        <div class="col-12 col-md-6">
                            <a href="#" class="btn btn-light btn-follow w-100">
                                Follow Artist
                            </a>
                        </div>

                        <div class="col-12 col-md-6">
                            <a href="#" class="btn btn-outline-light btn-profile w-100">
                                View Profile
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <!-- WHITE DIVIDER STRIP -->
    <section class="section-divider"></section>

    <section class="performance-section">
        <div class="container">

            <h2 class="performance-heading text-center mb-5">
                Performance Insights
            </h2>

            <div class="performance-card mx-auto">

                <div class="performance-row">
                    <span class="perf-label">BPM</span>
                    <span class="perf-value">128 BPM</span>
                </div>

                <div class="performance-row">
                    <span class="perf-label">Mood</span>
                    <span class="perf-value">Energetic</span>
                </div>

                <div class="performance-row">
                    <span class="perf-label">Genre</span>
                    <span class="perf-value">EDM / Future Bass</span>
                </div>

                <div class="performance-row">
                    <span class="perf-label">Tags</span>
                    <span class="perf-value">
                        “Club Mix”, “Electro”, “Live Set”
                    </span>
                </div>

            </div>

        </div>
    </section>

    <!-- =========================
                                                             COMMENTS SECTION
                                                        ========================= -->
    <section class="comments-section">
        <div class="container">

            <h2 class="comments-heading text-center mb-4">Comments</h2>

            <!-- Write comment -->
            <div class="comment-input">
                <i class="bi bi-camera"></i>
                <input type="text" placeholder="Write your reply..." />
                <div class="comment-input-actions">
                    <i class="bi bi-filetype-gif"></i>
                    <i class="bi bi-image"></i>
                </div>
            </div>

            <!-- Comment item -->
            <div class="comment-card">
                <div class="comment-user">
                    <img src="{{ asset('assets/images/profile1.jpg') }}" alt="user">
                </div>

                <div class="comment-body">
                    <div class="comment-header">
                        <strong>jake.travels_</strong>
                        <span class="time">5h ago</span>
                    </div>

                    <p>
                        seriously, that mid-afternoon crash is brutal. matcha = the hero we need 🙌
                    </p>
                    <hr class="comment-divider">

                    <div class="comment-footer">
                        <span class="reply">Reply</span>
                        <div class="likes">
                            <span>4 Likes</span>
                            <span class="emoji">👍</span>
                            <span class="emoji">😂</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comment item -->
            <div class="comment-card">
                <div class="comment-user">
                    <img src="{{ asset('assets/images/profile2.jpg') }}" alt="user">
                </div>

                <div class="comment-body">
                    <div class="comment-header">
                        <strong>linaa__</strong>
                        <span class="time">5h ago</span>
                    </div>

                    <p>
                        Totally feel this. Matcha is a 3pm lifesaver!
                    </p>
                    <hr class="comment-divider">
                    <div class="comment-footer">
                        <span class="reply">Reply</span>
                        <div class="likes">
                            <span>4 Likes</span>
                            <span class="emoji">👍</span>
                            <span class="emoji">😂</span>
                        </div>
                    </div>

                    <div class="view-replies">
                        View 3 more replies
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="more-like-this">
        <div class="container">
            {{-- Heading + Filters --}}
            <div
                class="submissions-head d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
                <h2 class="submissions-title m-0">More Like This</h2>

                <a href="#" class="btn btn-cta-amber">
                    <span class="btn-text">View All</span>
                    <span class="btn-arrow">→</span>
                </a>
            </div>

            {{-- Cards Grid --}}
            <div class="row g-4">

                {{-- Card 1 --}}
                <div class="col-md-6 col-lg-4">
                    <div class="submission-card">
                        <div class="submission-image">

                            <img src="{{ asset('assets/images/trend1.png') }}" alt="Submission">
                            <span class="role-tag">DJ</span>
                        </div>

                        <div class="submission-body">
                            <div class="meta-row">
                                <div class="meta-left">
                                    <span class="meta-item">
                                        <i class="bi bi-mic"></i> DJ Nova <span class="dot">•</span> 🇺🇸 USA
                                    </span>
                                </div>
                                <div class="meta-right">
                                    <span class="meta-item">
                                        <i class="bi bi-clock"></i> 45 Minutes
                                    </span>
                                </div>
                            </div>

                            <h5 class="submission-title">DJ Nova – “Midnight Surge”</h5>
                            <div class="votes-text">Votes: 32,480 Votes</div>

                            <a href="#" class="btn watch-pill w-100">Watch Video</a>
                        </div>
                    </div>
                </div>

                {{-- Card 2 --}}
                <div class="col-md-6 col-lg-4">
                    <div class="submission-card">
                        <div class="submission-image">
                            <img src="{{ asset('assets/images/trend2.png') }}" alt="Submission">
                            <span class="role-tag">Dancer</span>
                        </div>

                        <div class="submission-body">
                            <div class="meta-row">
                                <div class="meta-left">
                                    <span class="meta-item">
                                        <i class="bi bi-mic"></i> Aisha Blaze <span class="dot">•</span> 🇬🇧
                                        UK
                                    </span>
                                </div>
                                <div class="meta-right">
                                    <span class="meta-item">
                                        <i class="bi bi-clock"></i> 45 Minutes
                                    </span>
                                </div>
                            </div>

                            <h5 class="submission-title">Aisha Blaze – “Urban Pulse”</h5>
                            <div class="votes-text">Votes: 32,480 Votes</div>

                            <a href="#" class="btn watch-pill w-100">Watch Video</a>
                        </div>
                    </div>
                </div>

                {{-- Card 3 --}}
                <div class="col-md-6 col-lg-4">
                    <div class="submission-card">
                        <div class="submission-image">
                            <img src="{{ asset('assets/images/trend3.png') }}" alt="Submission">
                            <span class="role-tag">Producer</span>
                        </div>

                        <div class="submission-body">
                            <div class="meta-row">
                                <div class="meta-left">
                                    <span class="meta-item">
                                        <i class="bi bi-mic"></i> Hiro Beats <span class="dot">•</span> 🇯🇵
                                        Japan
                                    </span>
                                </div>
                                <div class="meta-right">
                                    <span class="meta-item">
                                        <i class="bi bi-clock"></i> 45 Minutes
                                    </span>
                                </div>
                            </div>

                            <h5 class="submission-title">Hiro Beats – “Galaxy Drift”</h5>
                            <div class="votes-text">Votes: 32,480 Votes</div>

                            <a href="#" class="btn watch-pill w-100">Watch Video</a>
                        </div>
                    </div>
                </div>



            </div>
        </div>

    </section>
@endsection

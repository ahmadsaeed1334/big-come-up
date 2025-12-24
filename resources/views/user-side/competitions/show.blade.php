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
                        Home - Competitions - <strong>DJ Competition</strong>
                    </div>

                    <h1 class="display-5 fw-bold text-white mb-2">
                        Global DJ Battle 2025
                    </h1>

                    <div class="d-flex justify-content-center align-items-center gap-2 text-white-50 mb-4">
                        <span class="live-dot"></span>
                        <span class="fw-semibold text-white">LIVE</span>
                        <span>•</span>
                        <span class="fw-semibold text-white">$10,000 Grand Prize</span>
                    </div>

                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="#" class="btn btn-cta-amber">
                            <span class="btn-text">Watch Submissions</span>
                            <span class="btn-arrow">→</span>
                        </a>

                        <a href="#" class="btn btn-cta-outline">
                            <span class="btn-text">Submit You Entry</span>
                            <span class="btn-arrow">→</span>
                        </a>
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

    {{-- ===== TABS + CONTENT (MAROON) - comes UP behind buttons ===== --}}


    {{-- ===== TABS + CONTENT (MAROON) - this comes UP behind actions ===== --}}
    <section class="comp-tabs-shell">
        <div class="container py-5">
            <ul class="nav comp-tabs mb-4" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tabOverview" type="button">
                        Overview
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabSubmissions" type="button">
                        Submissions
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabJudges" type="button">
                        Judges
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabLeaderboard" type="button">
                        Leaderboard
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabRules" type="button">
                        Rules
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                {{-- OVERVIEW --}}
                <div class="tab-pane fade show active" id="tabOverview">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-white mb-2">Competition Summary</h3>
                        <p class="text-white-50 mb-0">
                            The Global DJ Battle 2025 brings top DJs from around the world into one arena.
                            Submit your best performance and compete for the $10,000 grand prize.
                        </p>
                    </div>

                    <div class="glass-card p-4 mb-4">
                        <div class="row g-3">
                            <div class="col-md-6 d-flex justify-content-between border-bottom border-soft pb-2">
                                <span class="text-white-50">Category:</span>
                                <span class="text-white fw-semibold">DJ Competition</span>
                            </div>
                            <div class="col-md-6 d-flex justify-content-between border-bottom border-soft pb-2">
                                <span class="text-white-50">Format:</span>
                                <span class="text-white fw-semibold">YouTube / TikTok / Instagram video link</span>
                            </div>
                            <div class="col-md-6 d-flex justify-content-between border-bottom border-soft pb-2">
                                <span class="text-white-50">Video Duration Limit:</span>
                                <span class="text-white fw-semibold">2–5 minutes (strict)</span>
                            </div>
                            <div class="col-md-6 d-flex justify-content-between border-bottom border-soft pb-2">
                                <span class="text-white-50">Judging Criteria:</span>
                                <span class="text-white fw-semibold">Creativity, Technique, Energy, Originality</span>
                            </div>
                            <div class="col-md-6 d-flex justify-content-between">
                                <span class="text-white-50">Submission Limit:</span>
                                <span class="text-white fw-semibold">1 entry per competitor</span>
                            </div>
                        </div>
                    </div>

                    <div class="prize-strip d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                        <div>
                            <h4 class="mb-1 text-white fw-bold">Prize Pool</h4>
                            <div class="text-white fw-semibold">$10,000 Total Prize Money 💰</div>
                        </div>

                        <a href="#" class="btn btn-cta-amber btn-sm-pill">
                            <span class="btn-text">Submit Your Entry</span>
                            <span class="btn-arrow">→</span>
                        </a>
                    </div>

                    <div class="glass-card p-4">
                        <div class="row g-3">
                            <div class="col-md-6 d-flex justify-content-between border-bottom border-soft pb-2">
                                <span class="text-white-50">Submissions Open:</span>
                                <span class="text-white fw-semibold">Feb 1, 2025</span>
                            </div>
                            <div class="col-md-6 d-flex justify-content-between border-bottom border-soft pb-2">
                                <span class="text-white-50">Submissions Close:</span>
                                <span class="text-white fw-semibold">Feb 10, 2025</span>
                            </div>
                            <div class="col-md-6 d-flex justify-content-between border-bottom border-soft pb-2">
                                <span class="text-white-50">Public Voting:</span>
                                <span class="text-white fw-semibold">Feb 11–14</span>
                            </div>
                            <div class="col-md-6 d-flex justify-content-between border-bottom border-soft pb-2">
                                <span class="text-white-50">Judging Window:</span>
                                <span class="text-white fw-semibold">Feb 11–14</span>
                            </div>
                            <div class="col-md-6 d-flex justify-content-between">
                                <span class="text-white-50">Winner Announcement:</span>
                                <span class="text-white fw-semibold">Feb 15, 2025</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- OTHER TABS PLACEHOLDERS --}}
                <div class="tab-pane fade" id="tabSubmissions">

                    {{-- Heading + Filters --}}
                    <div
                        class="submissions-head d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
                        <h2 class="submissions-title m-0">Submissions</h2>

                        <div class="submissions-filters d-flex flex-wrap gap-3 justify-content-lg-end">
                            <select class="form-select filter-select">
                                <option selected>Duration</option>
                                <option>0-5 mins</option>
                                <option>5-10 mins</option>
                                <option>10+ mins</option>
                            </select>

                            <select class="form-select filter-select">
                                <option selected>Rank</option>
                                <option>Top Rated</option>
                                <option>Most Voted</option>
                                <option>Newest</option>
                            </select>

                            <select class="form-select filter-select">
                                <option selected>Genre</option>
                                <option>EDM</option>
                                <option>Hip-Hop</option>
                                <option>House</option>
                            </select>

                            <select class="form-select filter-select">
                                <option selected>Country</option>
                                <option>USA</option>
                                <option>UK</option>
                                <option>Japan</option>
                            </select>

                            <select class="form-select filter-select">
                                <option selected>Sort By</option>
                                <option>Newest</option>
                                <option>Oldest</option>
                                <option>Trending</option>
                            </select>
                        </div>
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

                        {{-- Repeat same 3 cards again (2nd row) --}}
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

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center mt-5">
                        <nav class="sub-pagination" aria-label="Submissions pagination">
                            <a class="page-btn disabled" href="#" aria-disabled="true">
                                <i class="bi bi-chevron-left"></i>
                            </a>

                            <a class="page-btn active" href="#">1</a>
                            <a class="page-btn" href="#">2</a>
                            <span class="page-dots">…</span>
                            <a class="page-btn" href="#">9</a>
                            <a class="page-btn" href="#">10</a>

                            <a class="page-btn" href="#">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </nav>
                    </div>

                </div>

                <div class="tab-pane fade" id="tabJudges" role="tabpanel" aria-labelledby="judges-tab">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-white mb-0">Meet The Judges</h3>
                    </div>

                    <div class="row g-4 justify-content-center">
                        <!-- Card 1 -->
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <article class="jcard">
                                <div class="jcard-media">
                                    <img src="{{ asset('assets/images/trend1.png') }}" alt="DJ Spectra">

                                    <span class="jcard-exp">15+ Years</span>

                                    <!-- AVATAR (perfect circle, on top) -->
                                    <div class="jcard-avatar">
                                        <img src="{{ asset('assets/images/profile1.jpg') }}" alt="DJ Spectra Avatar">
                                    </div>
                                </div>

                                <div class="jcard-body">
                                    <h5 class="jcard-name">DJ Spectra</h5>

                                    <div class="jcard-loc">
                                        <i class="bi bi-geo-alt"></i>
                                        <span>London, United Kingdom</span>
                                    </div>

                                    <span class="jcard-tag">
                                        EDM Headliner &amp; Festival Performer
                                    </span>

                                    <a href="#" class="btn jcard-btn w-100">
                                        View Judge Profile
                                    </a>
                                </div>
                            </article>

                        </div>

                        <!-- Card 2 -->
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <article class="jcard">
                                <div class="jcard-media">
                                    <img src="{{ asset('assets/images/trend1.png') }}" alt="DJ Spectra">

                                    <span class="jcard-exp">15+ Years</span>

                                    <!-- AVATAR (perfect circle, on top) -->
                                    <div class="jcard-avatar">
                                        <img src="{{ asset('assets/images/profile1.jpg') }}" alt="DJ Spectra Avatar">
                                    </div>
                                </div>

                                <div class="jcard-body">
                                    <h5 class="jcard-name">DJ Spectra</h5>

                                    <div class="jcard-loc">
                                        <i class="bi bi-geo-alt"></i>
                                        <span>London, United Kingdom</span>
                                    </div>

                                    <span class="jcard-tag">
                                        EDM Headliner &amp; Festival Performer
                                    </span>

                                    <a href="#" class="btn jcard-btn w-100">
                                        View Judge Profile
                                    </a>
                                </div>
                            </article>

                        </div>

                        <!-- Card 3 -->
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <article class="jcard">
                                <div class="jcard-media">
                                    <img src="{{ asset('assets/images/trend1.png') }}" alt="DJ Spectra">

                                    <span class="jcard-exp">15+ Years</span>

                                    <!-- AVATAR (perfect circle, on top) -->
                                    <div class="jcard-avatar">
                                        <img src="{{ asset('assets/images/profile1.jpg') }}" alt="DJ Spectra Avatar">
                                    </div>
                                </div>

                                <div class="jcard-body">
                                    <h5 class="jcard-name">DJ Spectra</h5>

                                    <div class="jcard-loc">
                                        <i class="bi bi-geo-alt"></i>
                                        <span>London, United Kingdom</span>
                                    </div>

                                    <span class="jcard-tag">
                                        EDM Headliner &amp; Festival Performer
                                    </span>

                                    <a href="#" class="btn jcard-btn w-100">
                                        View Judge Profile
                                    </a>
                                </div>
                            </article>

                        </div>

                        <!-- Card 4 -->
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <article class="jcard">
                                <div class="jcard-media">
                                    <img src="{{ asset('assets/images/trend1.png') }}" alt="DJ Spectra">

                                    <span class="jcard-exp">15+ Years</span>

                                    <!-- AVATAR (perfect circle, on top) -->
                                    <div class="jcard-avatar">
                                        <img src="{{ asset('assets/images/profile1.jpg') }}" alt="DJ Spectra Avatar">
                                    </div>
                                </div>

                                <div class="jcard-body">
                                    <h5 class="jcard-name">DJ Spectra</h5>

                                    <div class="jcard-loc">
                                        <i class="bi bi-geo-alt"></i>
                                        <span>London, United Kingdom</span>
                                    </div>

                                    <span class="jcard-tag">
                                        EDM Headliner &amp; Festival Performer
                                    </span>

                                    <a href="#" class="btn jcard-btn w-100">
                                        View Judge Profile
                                    </a>
                                </div>
                            </article>

                        </div>
                    </div>

                    <!-- Final Score strip -->
                    <div class="final-strip mt-5">
                        <div class="row align-items-center g-3 position-relative">
                            <div class="col-lg-8">
                                <div class="final-title">Final Score = 9.0</div>
                                <div class="final-meta">Votes: 32,480 Votes &nbsp; | &nbsp; Judge Score: 9.4 / 10</div>
                            </div>

                            <div class="col-lg-4 text-lg-end">
                                <a href="#" class="btn btn-cta-amber btn-sm-pill">
                                    <span class="btn-text">Submit Your Entry</span>
                                    <span class="btn-arrow">→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tabLeaderboard">

                    <!-- Heading + Filters -->
                    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
                        <h2 class="fw-bold text-white m-0">Most Ranked Submissions</h2>

                        <div class="d-flex flex-wrap gap-3">
                            <select class="form-select filter-select">
                                <option selected>Rank</option>
                                <option>Top 10</option>
                                <option>Top 50</option>
                            </select>

                            <select class="form-select filter-select">
                                <option selected>Genre</option>
                                <option>EDM</option>
                                <option>Hip-Hop</option>
                                <option>House</option>
                            </select>

                            <select class="form-select filter-select">
                                <option selected>Country</option>
                                <option>USA</option>
                                <option>UK</option>
                                <option>Japan</option>
                            </select>

                            <select class="form-select filter-select">
                                <option selected>Sort By</option>
                                <option>Rank</option>
                                <option>Votes</option>
                            </select>
                        </div>
                    </div>

                    <!-- Cards Grid -->
                    <div class="row g-4">

                        <!-- CARD -->
                        <div class="col-md-6 col-lg-4">
                            <article class="lcard">

                                <div class="lcard-media">
                                    <img src="{{ asset('assets/images/trend1.png') }}" alt="DJ Nova">

                                    <!-- Rank badge -->
                                    <span class="lcard-rank rank-gold">Rank 1</span>
                                </div>

                                <div class="lcard-body">

                                    <div class="lcard-meta">
                                        <span>
                                            <i class="bi bi-mic"></i> DJ Nova 🇺🇸 USA
                                        </span>
                                        <span>
                                            <i class="bi bi-clock"></i> 45 Minutes
                                        </span>
                                    </div>

                                    <h5 class="lcard-title">
                                        DJ Nova – “Midnight Surge”
                                    </h5>

                                    <div class="lcard-stats">
                                        Votes: 32,480 Votes &nbsp; | &nbsp; Judge Score: 9.4 / 10
                                    </div>

                                    <a href="#" class="btn lcard-btn w-100">
                                        Watch Video
                                    </a>

                                </div>
                            </article>
                        </div>

                        <!-- CARD -->
                        <div class="col-md-6 col-lg-4">
                            <article class="lcard">

                                <div class="lcard-media">
                                    <img src="{{ asset('assets/images/trend2.png') }}" alt="Aisha Blaze">
                                    <span class="lcard-rank rank-silver">Rank 2</span>
                                </div>

                                <div class="lcard-body">
                                    <div class="lcard-meta">
                                        <span><i class="bi bi-mic"></i> Aisha Blaze 🇬🇧 UK</span>
                                        <span><i class="bi bi-clock"></i> 45 Minutes</span>
                                    </div>

                                    <h5 class="lcard-title">
                                        Aisha Blaze – “Urban Pulse”
                                    </h5>

                                    <div class="lcard-stats">
                                        Votes: 32,480 Votes &nbsp; | &nbsp; Judge Score: 9.4 / 10
                                    </div>

                                    <a href="#" class="btn lcard-btn w-100">Watch Video</a>
                                </div>
                            </article>
                        </div>

                        <!-- CARD -->
                        <div class="col-md-6 col-lg-4">
                            <article class="lcard">

                                <div class="lcard-media">
                                    <img src="{{ asset('assets/images/trend3.png') }}" alt="Hiro Beats">
                                    <span class="lcard-rank rank-bronze">Rank 3</span>
                                </div>

                                <div class="lcard-body">
                                    <div class="lcard-meta">
                                        <span><i class="bi bi-mic"></i> Hiro Beats 🇯🇵 Japan</span>
                                        <span><i class="bi bi-clock"></i> 45 Minutes</span>
                                    </div>

                                    <h5 class="lcard-title">
                                        Hiro Beats – “Galaxy Drift”
                                    </h5>

                                    <div class="lcard-stats">
                                        Votes: 32,480 Votes &nbsp; | &nbsp; Judge Score: 9.4 / 10
                                    </div>

                                    <a href="#" class="btn lcard-btn w-100">Watch Video</a>
                                </div>
                            </article>
                        </div>

                    </div>
                </div>

                <div class="tab-pane fade" id="tabRules">

                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-white mb-0">Competition Rules</h3>
                    </div>

                    <!-- RULE CARD -->
                    <div class="rule-card mb-4">
                        <h4 class="rule-title">Eligibility Requirements</h4>

                        <div class="rule-auto">
                            <div class="rule-item">Participants must be 13+ years old.</div>
                            <div class="rule-item">Open to DJs worldwide — no location restrictions.</div>
                            <div class="rule-item">Only individual entries allowed (no groups/teams).</div>
                            <div class="rule-item">
                                User must have a valid, public YouTube/TikTok/Instagram account for video hosting.
                            </div>
                        </div>
                    </div>


                    <div class="rule-card mb-4">
                        <h4 class="rule-title">Video Submission Rules</h4>

                        <div class="rule-auto">
                            <div class="rule-item">Video length must be 2–5 minutes.</div>
                            <div class="rule-item">Only 1 submission per competitor is allowed.</div>
                            <div class="rule-item">
                                All videos must be submitted via YouTube / TikTok / Instagram link.
                            </div>
                            <div class="rule-item">Video must be public (not private or restricted).</div>
                            <div class="rule-item">
                                No copyrighted music unless you have rights or it falls under fair use.
                            </div>
                            <div class="rule-item">
                                Submissions must be your original performance (no re-uploaded content).
                            </div>
                        </div>
                    </div>

                    <div class="rule-card mb-4">
                        <h4 class="rule-title">Performance Restrictions</h4>

                        <div class="rule-auto">
                            <div class="rule-item">No offensive, hateful, or sexually explicit content.</div>
                            <div class="rule-item">
                                No dangerous activities or illegal actions shown in the video.
                            </div>
                            <div class="rule-item">
                                No repeated clips or AI-generated fake performances.
                            </div>
                            <div class="rule-item">
                                Using sound effects, scratches, transitions, and mixers is allowed,
                                but the performance must be live and authentic.
                            </div>
                        </div>
                    </div>

                    <div class="rule-card mb-4">
                        <h4 class="rule-title">Judge Scoring Rules</h4>

                        <div class="rule-auto rule-inline">
                            <div class="rule-item">Creativity</div>
                            <div class="rule-item">Technique</div>
                            <div class="rule-item">Energy & Crowd Control</div>
                            <div class="rule-item">Originality</div>
                            <div class="rule-item">Overall Performance Quality</div>
                        </div>
                    </div>

                    <div class="rule-card mb-4">
                        <h4 class="rule-title">Disqualification Grounds</h4>

                        <div class="rule-auto">
                            <div class="rule-item">Fake votes or bot activity is detected.</div>
                            <div class="rule-item">Copyrighted content is illegally used.</div>
                            <div class="rule-item">Video is plagiarized or stolen.</div>
                            <div class="rule-item">You violate community guidelines.</div>
                            <div class="rule-item">Multiple submissions are made.</div>
                            <div class="rule-item">
                                You attempt to manipulate judge scoring or system behavior.
                            </div>
                        </div>
                    </div>

                    <div class="rule-card mb-4">
                        <h4 class="rule-title">Content Rights</h4>

                        <div class="rule-auto">
                            <div class="rule-item">
                                You keep full ownership of your music/performance.
                            </div>
                            <div class="rule-item">
                                By submitting, you allow the platform to display your video on the competition page.
                            </div>
                            <div class="rule-item">
                                The platform does not download or host your video — only embeds it.
                            </div>
                        </div>
                    </div>

                    <div class="rule-card">
                        <h4 class="rule-title">Important Dates</h4>

                        <div class="rule-auto rule-inline">
                            <div class="rule-item">Submissions open: Feb 1, 2025</div>
                            <div class="rule-item">Submissions close: Feb 10, 2025</div>
                            <div class="rule-item">Judging: Feb 11–14</div>
                            <div class="rule-item">Voting window: Feb 11–14</div>
                            <div class="rule-item">Winners announcement: Feb 15</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

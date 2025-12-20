@extends('layouts.user-side')

@section('content')
    {{-- ===== HERO SHELL (same dots + gradient like home hero) ===== --}}
    <div class="hero-shell space-bg">
        {{-- navbar include --}}
        @include('user-side.partials.navbar')

        <section class="comp-hero">
            <div class="container">
                <div class="text-center">
                    <div class="crumb-pill mx-auto mb-3">
                        Home - Competitions - <strong>DJ Competition</strong>
                    </div>

                    <h1 class="display-5 fw-bold text-white mb-2">Global DJ Battle 2025</h1>

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

                {{-- buttons are OUTSIDE video card (figma style) --}}
                <div class="video-actions d-flex justify-content-center gap-3 flex-wrap">
                    <a class="btn btn-cta-amber btn-sm-pill" href="#">Vote Artist <span class="btn-arrow">→</span></a>
                    <a class="btn btn-share-pill btn-sm-pill" href="#">Share Performance <span
                            class="ms-1">↗</span></a>
                </div </div>
            </div>
    </section>

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
                            <div class="text-white-50 fw-semibold">$10,000 Total Prize Money 💰</div>
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
                            <article class="judge-card">
                                <div class="judge-media">
                                    <img src="{{ asset('assets/images/judges/j1.jpg') }}" alt="DJ Spectra">
                                    <span class="judge-exp">15+ Years</span>

                                    <div class="judge-avatar">
                                        <img src="{{ asset('assets/images/judges/a1.jpg') }}" alt="DJ Spectra Avatar">
                                    </div>
                                </div>

                                <div class="judge-body">
                                    <h5 class="judge-name">DJ Spectra</h5>

                                    <div class="judge-loc">
                                        <i class="bi bi-geo-alt"></i>
                                        <span>London, United Kingdom</span>
                                    </div>

                                    <span class="judge-tag">EDM Headliner &amp; Festival Performer</span>

                                    <a href="#" class="btn judge-btn w-100">View Judge Profile</a>
                                </div>
                            </article>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <article class="judge-card">
                                <div class="judge-media">
                                    <img src="{{ asset('assets/images/judges/j2.jpg') }}" alt="Maya Spin">
                                    <span class="judge-exp">10+ Years</span>

                                    <div class="judge-avatar">
                                        <img src="{{ asset('assets/images/judges/a2.jpg') }}" alt="Maya Spin Avatar">
                                    </div>
                                </div>

                                <div class="judge-body">
                                    <h5 class="judge-name">Maya Spin</h5>

                                    <div class="judge-loc">
                                        <i class="bi bi-geo-alt"></i>
                                        <span>London, United Kingdom</span>
                                    </div>

                                    <span class="judge-tag">Turntablist Champion</span>

                                    <a href="#" class="btn judge-btn w-100">View Judge Profile</a>
                                </div>
                            </article>
                        </div>

                        <!-- Card 3 -->
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <article class="judge-card">
                                <div class="judge-media">
                                    <img src="{{ asset('assets/images/judges/j3.jpg') }}" alt="Vortex Beats">
                                    <span class="judge-exp">15+ Years</span>

                                    <div class="judge-avatar">
                                        <img src="{{ asset('assets/images/judges/a3.jpg') }}" alt="Vortex Beats Avatar">
                                    </div>
                                </div>

                                <div class="judge-body">
                                    <h5 class="judge-name">Vortex Beats</h5>

                                    <div class="judge-loc">
                                        <i class="bi bi-geo-alt"></i>
                                        <span>London, United Kingdom</span>
                                    </div>

                                    <span class="judge-tag">Music Producer &amp; Sound Engineer</span>

                                    <a href="#" class="btn judge-btn w-100">View Judge Profile</a>
                                </div>
                            </article>
                        </div>

                        <!-- Card 4 -->
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <article class="judge-card">
                                <div class="judge-media">
                                    <img src="{{ asset('assets/images/judges/j4.jpg') }}" alt="DJ Kay Rush">
                                    <span class="judge-exp">15+ Years</span>

                                    <div class="judge-avatar">
                                        <img src="{{ asset('assets/images/judges/a4.jpg') }}" alt="DJ Kay Rush Avatar">
                                    </div>
                                </div>

                                <div class="judge-body">
                                    <h5 class="judge-name">DJ Kay Rush</h5>

                                    <div class="judge-loc">
                                        <i class="bi bi-geo-alt"></i>
                                        <span>London, United Kingdom</span>
                                    </div>

                                    <span class="judge-tag">Festival DJ &amp; Battle Judge</span>

                                    <a href="#" class="btn judge-btn w-100">View Judge Profile</a>
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
                    <div class="text-white-50">Leaderboard content here…</div>
                </div>
                <div class="tab-pane fade" id="tabRules">
                    <div class="text-white-50">Rules content here…</div>
                </div>
            </div>
        </div>
    </section>
@endsection

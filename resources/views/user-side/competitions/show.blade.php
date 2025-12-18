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

    {{-- ===== VIDEO STAGE (WHITE) - this overlaps hero like figma ===== --}}
    <section class="video-stage">
        <div class="container">
            <div class="video-card-wrap position-relative mx-auto">
                {{-- video card --}}
                <div class="video-card">
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

                    {{-- Video info and buttons INSIDE video card --}}
                    <div class="video-footer p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="text-white">
                                <div class="fw-bold">TERROR@1.USA</div>
                                <div class="text-white-50">Duration: 4:12</div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-cta-amber btn-sm-pill">
                                    <span class="btn-text">Vote Artist</span>
                                    <span class="btn-arrow">→</span>
                                </a>
                                <a href="#" class="btn btn-share-pill btn-sm-pill">
                                    <span class="btn-text">Share Performance</span>
                                    <span class="ms-2">↗</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                    <div class="text-white-50">Submissions content here…</div>
                </div>
                <div class="tab-pane fade" id="tabJudges">
                    <div class="text-white-50">Judges content here…</div>
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

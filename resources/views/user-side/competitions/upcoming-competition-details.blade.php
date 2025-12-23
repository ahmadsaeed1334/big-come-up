@extends('layouts.user-side')

@section('content')
    <div class="upcoming-hero-shell">

        @include('user-side.partials.navbar')

        <section class="upcoming-hero">
            <div class="container text-center">

                <div class="upcoming-breadcrumb">
                    Home - Competitions - <strong>Artist / Singer</strong>
                </div>

                <h1 class="upcoming-title">
                    Global DJ Battle 2025
                </h1>

                <div class="upcoming-meta">
                    <span>⏳ Starts in 2 Days</span>
                    <span class="dot">•</span>
                    <span>💰 $10,000 Grand Prize</span>
                </div>

            </div>
        </section>

    </div>
    {{-- =========================
   KEY INFORMATION SECTION
========================= --}}
    <section class="key-info-section">
        <div class="container">

            <h2 class="key-info-title">Key Information</h2>
            <p class="key-info-subtitle">
                The Global Artist Showcase 2025 is an upcoming opportunity for artists and
                singers to showcase their talent on a global stage.
            </p>

            <div class="row g-4 mt-4">

                <!-- Card 1 -->
                <div class="col-md-6">
                    <div class="key-info-card">
                        <div class="icon-box">
                            <img src="{{ asset('assets/svg/icon-users.svg') }}" alt="">
                        </div>
                        <div class="info-content">
                            <h4>Who Can Participate:</h4>
                            <p>Artists &amp; Singers</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-6">
                    <div class="key-info-card">
                        <div class="icon-box">
                            <img src="{{ asset('assets/svg/icon-judge.svg') }}" alt="">
                        </div>
                        <div class="info-content split">
                            <div>
                                <h4>Judging:</h4>
                                <p>Industry Judges + AI Scoring</p>
                            </div>
                            <div class="divider"></div>
                            <div>
                                <h4>Voting:</h4>
                                <p>Public voting enabled</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-6">
                    <div class="key-info-card">
                        <div class="icon-box">
                            <img src="{{ asset('assets/svg/icon-submit.svg') }}" alt="">
                        </div>
                        <div class="info-content">
                            <h4>Submission Format:</h4>
                            <p>YouTube / TikTok / Instagram link</p>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-md-6">
                    <div class="key-info-card">
                        <div class="icon-box">
                            <img src="{{ asset('assets/svg/icon-prize.svg') }}" alt="">
                        </div>
                        <div class="info-content">
                            <h4>Prize Type:</h4>
                            <p>Cash + Feature Opportunities</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="competition-info-dark-v2">
        <div class="container">
            <div class="info-grid">

                <!-- LEFT -->
                <div class="info-col">
                    <h2 class="info-title">Important Dates</h2>

                    <ul class="info-list-v2">
                        <li>
                            <span class="check-icon">✓</span>
                            Competition Opens:
                            <span class="highlight">Feb 20, 2025</span>
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            Submission Deadline:
                            <span class="highlight">Feb 28, 2025</span>
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            Voting Period:
                            <span class="highlight">Feb 20 — Mar 2</span>
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            Judging Period:
                            <span class="highlight">Mar 1 — Mar 3</span>
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            Winners Announced:
                            <span class="highlight">Mar 4, 2025</span>
                        </li>
                    </ul>
                </div>

                <!-- CENTER LINE -->
                <div class="center-divider"></div>

                <!-- RIGHT -->
                <div class="info-col">
                    <h2 class="info-title">Judges Preview</h2>

                    <ul class="info-list-v2">
                        <li><span class="check-icon">✓</span> Original performances only</li>
                        <li><span class="check-icon">✓</span> One submission per artist</li>
                        <li><span class="check-icon">✓</span> No offensive or copyrighted content</li>
                        <li><span class="check-icon">✓</span> Fair voting & fraud detection enabled</li>
                        <li>
                            <span class="check-icon">✓</span>
                            <span class="highlight">
                                Full rules will be available once the competition goes live.
                            </span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>
@endsection
